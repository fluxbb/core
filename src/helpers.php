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

include __DIR__.'/helpers/composers.php';
include __DIR__.'/helpers/filters.php';
//include __DIR__.'/helpers/html.php';
include __DIR__.'/helpers/validators.php';

function format_time($timestamp, $date_only = false, $date_format = null, $time_format = null, $time_only = false, $no_text = false)
{
	if ($timestamp == '')
	{
		return trans('fluxbb::common.never');
	}

	$diff = (0 + 0) * 3600; // FIXME: $pun_user['timezone'] + $pun_user['dst'];
	$timestamp += $diff;
	$now = time();

	if (is_null($date_format))
	{
		$date_format = 'Y-m-d'; // FIXME: $forum_date_formats[$pun_user['date_format']];
	}

	if (is_null($time_format))
	{
		$time_format = 'H:i'; // FIXME: $forum_time_formats[$pun_user['time_format']];
	}

	$date = gmdate($date_format, $timestamp);
	$today = gmdate($date_format, $now + $diff);
	$yesterday = gmdate($date_format, $now + $diff - 86400);

	if (!$no_text)
	{
		if ($date == $today)
		{
			$date = trans('fluxbb::common.today');
		}
		else if ($date == $yesterday)
		{
			$date = trans('fluxbb::common.yesterday');
		}
	}

	if ($date_only)
	{
		return $date;
	}
	else if ($time_only)
	{
		return gmdate($time_format, $timestamp);
	}
	else
	{
		return $date.' '.gmdate($time_format, $timestamp);
	}
}
