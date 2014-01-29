<?php

$prefix = Config::get('fluxbb.route_prefix', '');

Route::group(array('prefix' => $prefix, 'before' => 'fluxbb_is_installed'), function()
{
    Route::get('forum/{id}', array(
        'as'	=> 'viewforum',
        'uses'	=> 'FluxBB\Controllers\HomeController@get_forum',
    ));
    Route::get('topic/{id}', array(
        'as'	=> 'viewtopic',
        'uses'	=> 'FluxBB\Controllers\HomeController@get_topic',
    ));
    Route::get('post/{id}', array(
        'as'	=> 'viewpost',
        'uses'	=> 'FluxBB\Controllers\HomeController@get_post',
    ));
    Route::get('/', array(
        'as'	=> 'index',
        'uses'	=> 'FluxBB\Controllers\HomeController@get_index',
    ));
    Route::get('profile/{id}', array(
        'as'	=> 'profile',
        'uses'	=> 'FluxBB\Controllers\UsersController@get_profile',
    ));
    Route::post('profile/{id}', array(
        'uses'	=> 'FluxBB\Controllers\UsersController@post_profile',
    ));
    Route::get('users', array(
        'as'	=> 'userlist',
        'uses'	=> 'FluxBB\Controllers\UsersController@get_list',
    ));
    Route::get('register', array(
        'as'	=> 'register',
        'uses'	=> 'FluxBB\Controllers\AuthController@get_register',
    ));
    Route::post('register', array(
        'uses'	=> 'FluxBB\Controllers\AuthController@post_register',
    ));
    Route::get('login', array(
        'as'	=> 'login',
        'uses'	=> 'FluxBB\Controllers\AuthController@get_login',
    ));
    Route::post('login', array(
        'uses'	=> 'FluxBB\Controllers\AuthController@post_login',
    ));
    Route::get('forgot_password.html', array(
        'as'	=> 'forgot_password',
        'uses'	=> 'FluxBB\Controllers\AuthController@get_forgot',
    ));
    Route::get('logout', array(
        'as'	=> 'logout',
        'uses'	=> 'FluxBB\Controllers\AuthController@get_logout',
    ));
    Route::get('rules', array(
        'as'	=> 'rules',
        'uses'	=> 'FluxBB\Controllers\MiscController@get_rules',
    ));
    Route::get('email/{id}', array(
        'as'	=> 'email',
        'uses'	=> 'FluxBB\Controllers\MiscController@get_email',
    ));
    Route::get('search', array(
        'as'	=> 'search',
        'uses'	=> 'FluxBB\Controllers\SearchController@get_index',
    ));
    Route::get('post/{id}/report', array(
        'as'	=> 'post_report',
        'uses'	=> 'FluxBB\Controllers\PostingController@get_report',
    ));
    Route::get('post/{id}/delete', array(
        'as'	=> 'post_delete',
        'uses'	=> 'FluxBB\Controllers\PostingController@get_delete',
    ));
    Route::get('post/{id}/edit', array(
        'as'	=> 'post_edit',
        'uses'	=> 'FluxBB\Controllers\PostingController@get_edit',
    ));
    Route::post('post/{id}/edit', array(
        'uses'  => 'FluxBB\Controllers\PostingController@post_edit',
    ));
    Route::get('post/{id}/quote', array(
        'as'	=> 'post_quote',
        'uses'	=> 'FluxBB\Controllers\PostingController@get_quote',
    ));
    Route::get('topic/{id}/reply', array(
        'as'	=> 'reply',
        'uses'	=> 'FluxBB\Controllers\PostingController@get_reply',
    ));
    Route::post('topic/{id}/reply', array(
        'uses'	=> 'FluxBB\Controllers\PostingController@post_reply',
    ));
    Route::get('forum/{id}/topic/new', array(
        'as'	=> 'new_topic',
        'uses'	=> 'FluxBB\Controllers\PostingController@get_topic',
    ));
    Route::post('forum/{id}/topic/new', array(
        'uses'	=> 'FluxBB\Controllers\PostingController@post_topic',
    ));

    Route::bind('group', function($value, $route)
    {
        return App::make('FluxBB\Models\GroupRepositoryInterface')->find($value);
    });

Route::group(array('before' => 'auth'), function()
{
    Route::get('admin', array(
        'as'	=> 'admin',
        'uses'	=> 'FluxBB\Controllers\Admin\DashboardController@get_index',
    ));

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
        'uses'	=> 'FluxBB\Controllers\Admin\AjaxController@post_board_config',
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

    Route::get('admin/dashboard/notes', array(
        'as' => 'admin_dashboard_notes',
        'uses' => 'FluxBB\Controllers\Admin\DashboardController@getNotes',
    ));

    Route::get('admin/dashboard/backup', array(
        'as' => 'admin_dashboard_backup',
        'uses' => 'FluxBB\Controllers\Admin\DashboardController@getBackup',
    ));

});


});



