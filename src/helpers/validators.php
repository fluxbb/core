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

Validator::addExtension('email_not_banned', function($attribute, $value, $parameters)
{
	$bans = FluxBB\Models\Ban::all();

	foreach ($bans as $cur_ban)
	{
		if (!empty($cur_ban->email) &&
			($value == $cur_ban->email ||
			(!str_contains($cur_ban->email, '@') && str_contains(strtolower($value), '@'.$cur_ban->email))))
		{
			return false;
		}
	}

	return true;
});

Validator::addExtension('username_not_banned', function($attribute, $value, $parameters)
{
	$bans = FluxBB\Models\Ban::all();

	foreach ($bans as $cur_ban)
	{
		// TODO: utf8_strtolower()? Or maybe strcasecmp() if that supports UTF-8?
		if (!empty($cur_ban->username) && strtolower($value) == strtolower($cur_ban->username))
		{
			return false;
		}
	}

	return true;
});

Validator::addExtension('username_not_guest', function($attribute, $value, $parameters)
{
	return strcasecmp($value, 'Guest') && strcasecmp($value, trans('fluxbb::common.guest'));
});

Validator::addExtension('username_not_reserved', function($attribute, $value, $parameters)
{
	return !str_contains($value, array('[', ']', '\'', '"'));
});

Validator::addExtension('no_ip', function($attribute, $value, $parameters)
{
	return !preg_match('%[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}%', $value) && !preg_match('%((([0-9A-Fa-f]{1,4}:){7}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){6}:[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){5}:([0-9A-Fa-f]{1,4}:)?[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){4}:([0-9A-Fa-f]{1,4}:){0,2}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){3}:([0-9A-Fa-f]{1,4}:){0,3}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){2}:([0-9A-Fa-f]{1,4}:){0,4}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){6}((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|(([0-9A-Fa-f]{1,4}:){0,5}:((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|(::([0-9A-Fa-f]{1,4}:){0,5}((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|([0-9A-Fa-f]{1,4}::([0-9A-Fa-f]{1,4}:){0,5}[0-9A-Fa-f]{1,4})|(::([0-9A-Fa-f]{1,4}:){0,6}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){1,7}:))%', $value);
});

Validator::addExtension('no_bbcode', function($attribute, $value, $parameters)
{
	return !preg_match('%(?:\[/?(?:b|u|s|ins|del|em|i|h|colou?r|quote|code|img|url|email|list|\*|topic|post|forum|user)\]|\[(?:img|url|quote|list)=)%i', $value);
});

Validator::addExtension('not_censored', function($attribute, $value, $parameters)
{
	if (FluxBB\Models\Config::disabled('o_censoring'))
	{
		return true;
	}

	return FluxBB\Models\Censor::is_clean($username);
});
