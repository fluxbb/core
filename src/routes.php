<?php

$prefix = Config::get('fluxbb.route_prefix', '');

$router = new FluxBB\Server\Router;
$router->get('/', 'index');
$router->get('forum/{id}', 'viewforum');
$router->get('topic/{id}', 'viewtopic');
$router->get('post/{id}', 'viewpost');
$router->get('register', 'register');
$router->post('register', 'handle_registration');
$router->get('login', 'login');
$router->post('login', 'handle_login');
$router->get('logout', 'logout');
$router->get('reset_password', 'reset_password');
$router->get('profile/{id}', 'profile');
$router->get('users', 'userlist');
$router->get('rules', 'rules');
$router->get('search', 'search');

$server = App::make('FluxBB\Server\Server');
$server->register('index', 'FluxBB\Actions\Home');
$server->register('viewforum', 'FluxBB\Actions\ViewForum');
$server->register('viewtopic', 'FluxBB\Actions\ViewTopic');
$server->register('viewpost', 'FluxBB\Actions\ViewPost');
$server->register('register', 'FluxBB\Actions\RegisterPage');
$server->register('handle_registration', 'FluxBB\Actions\Register');
$server->register('login', 'FluxBB\Actions\LoginPage');
$server->register('handle_login', 'FluxBB\Actions\Login');
$server->register('logout', 'FluxBB\Actions\Logout');
$server->register('reset_password', 'FluxBB\Actions\PasswordResetPage');
$server->register('profile', 'FluxBB\Actions\ProfilePage');
$server->register('userlist', 'FluxBB\Actions\UsersPage');
$server->register('rules', 'FluxBB\Actions\Rules');
$server->register('search', 'FluxBB\Actions\SearchPage');

Route::any($prefix.'/{uri}', function ($uri) use ($prefix, $router, $server) {
    $method = Request::method();

    $request = $router->getRequest($method, $uri);

    $action = $server->resolve($request->getHandler());
    return $action->handle($request);
})->where('uri', '.*');

/*Route::group(array('prefix' => $prefix, 'before' => 'fluxbb_is_installed'), function () {
    $actionRoute = function ($actionClass) {
        return function () use ($actionClass) {
            $action = App::make($actionClass);
            return $action->handle(app('request'));
        };
    };


    Route::get('post/{id}/report', array(
        'as'	=> 'post_report',
        'uses'	=> 'FluxBB\Controllers\PostingController@getReport',
    ));
    Route::get('post/{id}/delete', array(
        'as'	=> 'post_delete',
        'uses'	=> 'FluxBB\Controllers\PostingController@getDelete',
    ));
    Route::get('post/{id}/edit', array('as' => 'post_edit', 'uses' => $actionRoute('FluxBB\Actions\EditPostPage')));
    Route::post('post/{id}/edit', $actionRoute('FluxBB\Actions\EditPost'));
    Route::get('post/{id}/quote', array(
        'as'	=> 'post_quote',
        'uses'	=> 'FluxBB\Controllers\PostingController@getQuote',
    ));
    Route::get('topic/{id}/reply', array('as' => 'reply', 'uses' => $actionRoute('FluxBB\Actions\ReplyPage')));
    Route::post('topic/{id}/reply', $actionRoute('FluxBB\Actions\Reply'));
    Route::get('forum/{id}/topic/new', array('as' => 'new_topic', 'uses' => $actionRoute('FluxBB\Actions\NewTopicPage')));
    Route::post('forum/{id}/topic/new', $actionRoute('FluxBB\Actions\NewTopic'));

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

        Route::get('admin/settings', ['as' => 'admin_settings_global', 'uses' => $actionRoute('FluxBB\Actions\Admin\GlobalSettingsPage')]);
        Route::get('admin/settings/email', ['as' => 'admin_settings_email', 'uses' => $actionRoute('FluxBB\Actions\Admin\EmailSettingsPage')]);
        Route::get('admin/settings/maintenance', ['as' => 'admin_settings_maintenance', 'uses' => $actionRoute('FluxBB\Actions\Admin\MaintenanceSettingsPage')]);
        Route::post('admin/settings/{key}', array(
            'uses'  => 'FluxBB\Controllers\Admin\SettingsController@setOption'
        ));

        Route::post('admin/ajax/board_config', array(
            'as'    => 'admin_ajax_board_config',
            'uses'  => 'FluxBB\Controllers\Admin\AjaxController@postBoardConfig',
        ));

        Route::get('admin/settings/logs', array(
            'as' => 'admin_settings_logs',
            'uses' => 'FluxBB\Controllers\Admin\SettingsController@getLogs',
        ));

        Route::get('admin/dashboard/updates', ['as' => 'admin_dashboard_updates', 'uses' => $actionRoute('FluxBB\Actions\Admin\UpdatesPage')]);
        Route::get('admin/dashboard/stats', ['as' => 'admin_dashboard_stats', 'uses' => $actionRoute('FluxBB\Actions\Admin\StatsPage')]);
        Route::get('admin/dashboard/reports', ['as' => 'admin_dashboard_reports', 'uses' => $actionRoute('FluxBB\Actions\Admin\ReportsPage')]);
    });


});*/
