<?php

use FluxBB\Models\Ban;
use FluxBB\Models\Config;

Validator::extend('email_not_banned', function ($attribute, $value, $parameters) {
    $bans = Ban::all();

    foreach ($bans as $cur_ban) {
        if (!empty($cur_ban->email) &&
            ($value == $cur_ban->email ||
            (!str_contains($cur_ban->email, '@') && str_contains(strtolower($value), '@'.$cur_ban->email)))
        ) {
            return false;
        }
    }

    return true;
});

Validator::extend('username_not_banned', function ($attribute, $value, $parameters) {
    $bans = Ban::all();

    foreach ($bans as $cur_ban) {
        // TODO: utf8_strtolower()? Or maybe strcasecmp() if that supports UTF-8?
        if (!empty($cur_ban->username) && strtolower($value) == strtolower($cur_ban->username)) {
            return false;
        }
    }

    return true;
});

Validator::extend('username_not_guest', function ($attribute, $value, $parameters) {
    return strcasecmp($value, 'Guest') && strcasecmp($value, trans('fluxbb::common.guest'));
});

Validator::extend('username_not_reserved', function ($attribute, $value, $parameters) {
    return !str_contains($value, array('[', ']', '\'', '"'));
});

Validator::extend('no_ip', function ($attribute, $value, $parameters) {
    return !preg_match('%[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}%', $value) && !preg_match('%((([0-9A-Fa-f]{1,4}:){7}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){6}:[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){5}:([0-9A-Fa-f]{1,4}:)?[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){4}:([0-9A-Fa-f]{1,4}:){0,2}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){3}:([0-9A-Fa-f]{1,4}:){0,3}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){2}:([0-9A-Fa-f]{1,4}:){0,4}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){6}((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|(([0-9A-Fa-f]{1,4}:){0,5}:((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|(::([0-9A-Fa-f]{1,4}:){0,5}((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|([0-9A-Fa-f]{1,4}::([0-9A-Fa-f]{1,4}:){0,5}[0-9A-Fa-f]{1,4})|(::([0-9A-Fa-f]{1,4}:){0,6}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){1,7}:))%', $value);
});

Validator::extend('no_bbcode', function ($attribute, $value, $parameters) {
    return !preg_match('%(?:\[/?(?:b|u|s|ins|del|em|i|h|colou?r|quote|code|img|url|email|list|\*|topic|post|forum|user)\]|\[(?:img|url|quote|list)=)%i', $value);
});
