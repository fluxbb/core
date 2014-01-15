<?php

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
