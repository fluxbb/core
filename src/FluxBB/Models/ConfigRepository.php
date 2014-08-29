<?php

namespace FluxBB\Models;

use Illuminate\Cache\Repository;
use Illuminate\Database\ConnectionInterface;

class ConfigRepository implements ConfigRepositoryInterface
{
    /**
     * @var \Illuminate\Cache\Repository
     */
    protected $cache;

    /**
     * @var \Illuminate\Database\ConnectionInterface
     */
    protected $database;

    protected $loaded = false;

    protected $data;

    protected $original;


    public function __construct(Repository $cache, ConnectionInterface $database)
    {
        $this->cache = $cache;
        $this->database = $database;
    }

    protected function data()
    {
        if (!$this->loaded) {
            $this->data = $this->original = $this->cache->remember('fluxbb.config', 24 * 60, function () {
                $data = $this->database->table('config')->get();
                $cache = array();

                foreach ($data as $row) {
                    $cache[$row->conf_name] = $row->conf_value;
                }

                return $cache;
            });

            $this->loaded = true;
        }

        return $this->data;
    }

    public function has($key)
    {
        return array_key_exists($key, $this->data());
    }

    public function get($key = null)
    {
        return array_get($this->data(), $key);
    }

    public function set($key, $value)
    {
        $this->data()[$key] = $value;
    }

    public function isEnabled($key)
    {
        return $this->get('o_'.$key) === '1';
    }

    public function isDisabled($key)
    {
        return $this->get('o_'.$key) === '0';
    }

    public function save()
    {
        // New and changed keys
        $changed = array_diff_assoc($this->data, $this->original);

        $insertValues = array();
        foreach ($changed as $name => $value) {
            if (!array_key_exists($name, $this->original)) {
                $insertValues[] = array(
                    'conf_name'     => $name,
                    'conf_value'    => $value,
                );

                unset($changed[$name]);
            }
        }

        if (!empty($insertValues)) {
            $this->database->table('config')->insert($insertValues);
        }

        foreach ($changed as $name => $value) {
            $this->database->table('config')->where('conf_name', '=', $name)->update(array('conf_value' => $value));
        }

        // Deleted keys
        $deletedKeys = array_keys(array_diff_key($this->original, $this->data));
        if (!empty($deletedKeys)) {
            $this->database->table('config')->whereIn('conf_name', $deletedKeys)->delete();
        }

        // No need to cache old values anymore
        $this->original = $this->data;

        // Delete the cache so that it will be regenerated on the next request
        $this->cache->pull('fluxbb.config');
    }
}
