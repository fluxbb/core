<?php

$prefix = Config::get('fluxbb.route_prefix', '');

Route::group(array('prefix' => $prefix, 'before' => 'fluxbb_is_installed'), function () {
    $actionRoute = function ($actionClass) {
        return function () use ($actionClass) {
            $action = App::make($actionClass);
            return $action->handle(app('request'));
        };
    };

    Route::get('forum/{id}', array('as' => 'viewforum', 'uses' => $actionRoute('FluxBB\Actions\ViewForum')));
    Route::get('topic/{id}', array(
        'as'	=> 'viewtopic',
        'uses'	=> 'FluxBB\Controllers\HomeController@getTopic',
    ));
    Route::get('post/{id}', array(
        'as'	=> 'viewpost',
        'uses'	=> 'FluxBB\Controllers\HomeController@getPost',
    ));
    Route::get('/', array(
        'as'	=> 'index',
        'uses'	=> 'FluxBB\Controllers\HomeController@getIndex',
    ));
    Route::get('profile/{id}', array(
        'as'	=> 'profile',
        'uses'	=> 'FluxBB\Controllers\UsersController@getProfile',
    ));
    Route::post('profile/{id}', array(
        'uses'	=> 'FluxBB\Controllers\UsersController@postProfile',
    ));
    Route::get('users', array(
        'as'	=> 'userlist',
        'uses'	=> 'FluxBB\Controllers\UsersController@getList',
    ));

    Route::get('register', array('as' => 'register', 'uses' => $actionRoute('FluxBB\Actions\RegisterPage')));
    Route::post('register', $actionRoute('FluxBB\Actions\Register'));
    Route::get('login', array('as' => 'login', 'uses' => $actionRoute('FluxBB\Actions\LoginPage')));
    Route::post('login', $actionRoute('FluxBB\Actions\Login'));
    Route::get('forgot_password.html', array(
        'as'	=> 'forgot_password',
        'uses'	=> 'FluxBB\Controllers\AuthController@getForgot',
    ));
    Route::get('logout', array('as' => 'logout', 'uses' => $actionRoute('FluxBB\Actions\Logout')));
    Route::get('rules', array(
        'as'	=> 'rules',
        'uses'	=> 'FluxBB\Controllers\MiscController@getRules',
    ));
    Route::get('email/{id}', array(
        'as'	=> 'email',
        'uses'	=> 'FluxBB\Controllers\MiscController@getEmail',
    ));
    Route::get('search', array(
        'as'	=> 'search',
        'uses'	=> 'FluxBB\Controllers\SearchController@getIndex',
    ));
    Route::get('post/{id}/report', array(
        'as'	=> 'post_report',
        'uses'	=> 'FluxBB\Controllers\PostingController@getReport',
    ));
    Route::get('post/{id}/delete', array(
        'as'	=> 'post_delete',
        'uses'	=> 'FluxBB\Controllers\PostingController@getDelete',
    ));
    Route::get('post/{id}/edit', array(
        'as'	=> 'post_edit',
        'uses'	=> 'FluxBB\Controllers\PostingController@getEdit',
    ));
    Route::post('post/{id}/edit', array(
        'uses'  => 'FluxBB\Controllers\PostingController@postEdit',
    ));
    Route::get('post/{id}/quote', array(
        'as'	=> 'post_quote',
        'uses'	=> 'FluxBB\Controllers\PostingController@getQuote',
    ));
    Route::get('topic/{id}/reply', array(
        'as'	=> 'reply',
        'uses'	=> 'FluxBB\Controllers\PostingController@getReply',
    ));
    Route::post('topic/{id}/reply', array(
        'uses'	=> 'FluxBB\Controllers\PostingController@postReply',
    ));
    Route::get('forum/{id}/topic/new', array(
        'as'	=> 'new_topic',
        'uses'	=> 'FluxBB\Controllers\PostingController@getTopic',
    ));
    Route::post('forum/{id}/topic/new', array(
        'uses'	=> 'FluxBB\Controllers\PostingController@postTopic',
    ));

    Route::bind('group', function ($value, $route) {
        return App::make('FluxBB\Models\GroupRepositoryInterface')->find($value);
    });

    Route::group(array('before' => 'auth'), function () use ($actionRoute) {
        Route::get('admin', array('as' => 'admin', 'uses' => $actionRoute('FluxBB\Actions\Admin\DashboardPage')));

        Route::get('admin/groups', array(
            'as'	=> 'admin_groups_index',
            'uses'	=> 'FluxBB\Controllers\Admin\GroupsController@index',
        ));
        Route::get('admin/groups/{group}/edit', array(
            'as'	=> 'admin_groups_edit',
            'uses'	=> 'FluxBB\Controllers\Admin\GroupsController@edit',
        ));
        Route::get('admin/groups/{group}/delete', array(
            'as'	=> 'admin_groups_delete',
            'uses'	=> 'FluxBB\Controllers\Admin\GroupsController@delete',
        ));
        Route::post('admin/groups/{group}/delete', array(
            'uses'	=> 'FluxBB\Controllers\Admin\GroupsController@remove',
        ));

        Route::get('admin/settings', array(
            'as'	=> 'admin_settings_global',
            'uses'	=> 'FluxBB\Controllers\Admin\SettingsController@getGlobal',
        ));
        Route::post('admin/settings/{key}', array(
            'uses'	=> 'FluxBB\Controllers\Admin\SettingsController@setOption'
        ));

        Route::post('admin/ajax/board_config', array(
            'as'	=> 'admin_ajax_board_config',
            'uses'	=> 'FluxBB\Controllers\Admin\AjaxController@postBoardConfig',
        ));
        Route::get('admin/settings/email', array(
            'as' => 'admin_settings_email',
            'uses' => 'FluxBB\Controllers\Admin\SettingsController@getEmail',
        ));
        Route::get('admin/settings/maintenance', array(
            'as' => 'admin_settings_maintenance',
            'uses' => 'FluxBB\Controllers\Admin\SettingsController@getMaintenance',
        ));

        /* Route::get('admin/settings/logs', array(
            'as' => 'admin_settings_logs',
            'uses' => 'FluxBB\Controllers\Admin\SettingsController@getLogs',
        ));
        */

        Route::get('admin/dashboard/updates', array(
            'as' => 'admin_dashboard_updates',
            'uses' => 'FluxBB\Controllers\Admin\DashboardController@getUpdates',
        ));

        Route::get('admin/dashboard/stats', array(
            'as' => 'admin_dashboard_stats',
            'uses' => 'FluxBB\Controllers\Admin\DashboardController@getStats',
        ));

        Route::get('admin/dashboard/reports', array(
            'as' => 'admin_dashboard_reports',
            'uses' => 'FluxBB\Controllers\Admin\DashboardController@getReports',
        ));

    });


});
