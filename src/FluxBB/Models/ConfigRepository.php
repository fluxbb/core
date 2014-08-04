<?php

namespace FluxBB\Models;

use Illuminate\Cache\CacheManager;
use DB;

class ConfigRepository implements ConfigRepositoryInterface
{
    protected $loaded = false;

    protected $cache;

    public function __construct(CacheManager $cache)
    {
        $this->cache = $cache;
    }

    public function getGlobal()
    {
        return array();
    }

    protected function loadData()
    {
        if ($this->loaded) {
            return;
        }

        $this->data = $this->original = $this->cache->remember('fluxbb.config', 24 * 60, function () {
            $data = DB::connection('fluxbb')->table('config')->get();
            $cache = array();

            foreach ($data as $row) {
                $cache[$row->conf_name] = $row->conf_value;
            }

            return $cache;
        });

        $this->loaded = true;
    }

    public function get($key)
    {
        $this->loadData();
        return $this->data[$key];
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
            DB::connection('fluxbb')->table('config')->insert($insert_values);
        }

        foreach ($changed as $name => $value) {
            DB::connection('fluxbb')->table('config')->where('conf_name', '=', $name)->update(array('conf_value' => $value));
        }

        // Deleted keys
        $deleted_keys = array_keys(array_diff_key($this->original, $this->data));
        if (!empty($deleted_keys)) {
            DB::connection('fluxbb')->table('config')->whereIn('conf_name', $deleted_keys)->delete();
        }

        // No need to cache old values anymore
        $this->original = $this->data;

        // Delete the cache so that it will be regenerated on the next request
        $this->cache->forget('fluxbb.config');
    }
}
