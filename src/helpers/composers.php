<?php

use FluxBB\Models\Config;
use FluxBB\Core;

View::composer('fluxbb::layout.main', function ($view) {
    $view->with('language', trans('fluxbb::common.lang_identifier'))
         ->with('direction', trans('fluxbb::common.lang_direction'))
         ->with('charset', \Config::get('fluxbb.database.charset'))
         ->with('head', '')
         ->with('page', 'index')
         ->with('board_title', Config::get('o_board_title'))
         ->with('board_description', Config::get('o_board_desc'))
         ->with('navlinks', '<ul><li><a href="#">Home</a></li></ul>')
         ->with('status', 'You are not logged in.')
         ->with('announcement', '');
});

View::composer('fluxbb::user.profile.menu', function ($view) {
    $items = array(
        'essentials'    => trans('fluxbb::profile.section_essentials'),
        'personal'      => trans('fluxbb::profile.section_personal'),
        'personality'   => trans('fluxbb::profile.section_personality'),
        'display'       => trans('fluxbb::profile.section_display'),
        'privacy'       => trans('fluxbb::profile.section_privacy')
    );

    if (Auth::check() && Auth::user()->isAdmin()) {
        $items['admin'] = trans('fluxbb::profile.section_admin');
    }

    // TODO: Determine current action
    $view->with('action', 'profile')
         ->with('items', $items);
});

View::composer('fluxbb::admin.layout.main', function ($view) {
    $view->with('language', trans('fluxbb::common.lang_identifier'))
         ->with('direction', trans('fluxbb::common.lang_direction'))
         ->with('charset', \Config::get('fluxbb.database.charset'))
         ->with('board_title', Config::get('o_board_title'))
         ->with('board_description', Config::get('o_board_desc'))
         ->with('version', Core::version());
});
