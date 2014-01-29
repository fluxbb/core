<?php

namespace FluxBB\Models;

use Cache;
use DB;

class Config
{
    protected static $loaded = false;

    protected static $data = array();

    protected static $original = array();


    protected static function loadData()
    {
        if (static::$loaded) {
            return;
        }

        static::$data = static::$original = Cache::remember('fluxbb.config', 24 * 60, function() {
            $data = DB::table('config')->get();
            $cache = array();

            foreach ($data as $row) {
                $cache[$row->conf_name] = $row->conf_value;
            }

            return $cache;
        });

        static::$loaded = true;
    }

    public static function get($key, $default = null)
    {
        static::loadData();

        if (array_key_exists($key, static::$data)) {
            return static::$data[$key];
        }

        return $default;
    }

    public static function enabled($key)
    {
        return static::get($key, 0) == 1;
    }

    public static function disabled($key)
    {
        return static::get($key, 0) == 0;
    }

    public static function set($key, $value)
    {
        static::loadData();

        static::$data[$key] = $value;
    }

    public static function delete($key)
    {
        static::loadData();

        unset(static::$data[$key]);
    }

    public static function save()
    {
        // New and changed keys
        $changed = array_diff_assoc(static::$data, static::$original);

        $insert_values = array();
        foreach ($changed as $name => $value) {
            if (!array_key_exists($name, static::$original)) {
                $insert_values[] = array(
                    'conf_name'		=> $name,
                    'conf_value'	=> $value,
                );

                unset($changed[$name]);
            }
        }

        if (!empty($insert_values)) {
            DB::table('config')->insert($insert_values);
        }

        foreach ($changed as $name => $value) {
            DB::table('config')->where('conf_name', '=', $name)->update(array('conf_value' => $value));
        }

        // Deleted keys
        $deleted_keys = array_keys(array_diff_key(static::$original, static::$data));
        if (!empty($deleted_keys)) {
            DB::table('config')->whereIn('conf_name', $deleted_keys)->delete();
        }

        // No need to cache old values anymore
        static::$original = static::$data;

        // Delete the cache so that it will be regenerated on the next request
        Cache::forget('fluxbb.config');
    }
}
