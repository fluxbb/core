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

    protected function loadData()
    {
        if ($this->loaded) {
            return;
        }

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

    public function has($key)
    {
        $this->loadData();
        return array_key_exists($key, $this->data);
    }

    public function get($key = null)
    {
        $this->loadData();
        return array_get($this->data, $key);
    }

    public function set($key, $value)
    {
        $this->loadData();
        $this->data[$key] = $value;
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

        $insert_values = array();
        foreach ($changed as $name => $value) {
            if (!array_key_exists($name, $this->original)) {
                $insert_values[] = array(
                    'conf_name'     => $name,
                    'conf_value'    => $value,
                );

                unset($changed[$name]);
            }
        }

        if (!empty($insert_values)) {
            $this->database->table('config')->insert($insert_values);
        }

        foreach ($changed as $name => $value) {
            $this->database->table('config')->where('conf_name', '=', $name)->update(array('conf_value' => $value));
        }

        // Deleted keys
        $deleted_keys = array_keys(array_diff_key($this->original, $this->data));
        if (!empty($deleted_keys)) {
            $this->database->table('config')->whereIn('conf_name', $deleted_keys)->delete();
        }

        // No need to cache old values anymore
        $this->original = $this->data;

        // Delete the cache so that it will be regenerated on the next request
        $this->cache->pull('fluxbb.config');
    }
}
