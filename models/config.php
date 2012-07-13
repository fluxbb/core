<?php
/**
 * FluxBB - fast, light, user-friendly PHP forum software
 * Copyright (C) 2008-2012 FluxBB.org
 * based on code by Rickard Andersson copyright (C) 2002-2008 PunBB
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public license for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @category	FluxBB
 * @package		Core
 * @copyright	Copyright (c) 2008-2012 FluxBB (http://fluxbb.org)
 * @license		http://www.gnu.org/licenses/gpl.html	GNU General Public License
 */

namespace fluxbb;

use Cache;
use DB;

class Config
{
	protected static $loaded = false;

	protected static $data = array();

	protected static function data()
	{
		if (!static::$loaded)
		{
			static::$data = Cache::remember('fluxbb.config', function()
			{
				$data = DB::table('config')->get();
				$cache = array();

				foreach ($data as $row)
				{
					$cache[$row->conf_name] = $row->conf_value;
				}

				return $cache;
			}, 24 * 60);

			static::$loaded = true;
		}

		return static::$data;
	}

	public static function get($key, $default = null)
	{
		$data = static::data();

		if (array_key_exists($key, $data))
		{
			return $data[$key];
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

}
