<?php

use FluxBB\Models\Config;

View::composer('fluxbb::layout.main', function ($view) {
    $view->with('language', 'en')
         ->with('direction', 'ltr')
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
        'essentials'    => 'Essentials',
        'personal'      => 'Personal',
        'personality'   => 'Personality',
        'display'       => 'Display',
        'privacy'       => 'Privacy',
    );

    if (Auth::check() && Auth::user()->isAdmin()) {
        $items['admin'] = 'Administration';
    }

    // TODO: Determine current action
    $view->with('action', 'profile')
         ->with('items', $items);
});

View::composer('fluxbb::admin.layout.header', function ($view) {
    $view->with('board_title', Config::get('o_board_title'))
         ->with('board_description', Config::get('o_board_desc'));
});
