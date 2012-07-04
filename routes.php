<?php

Route::get('(:bundle)/forum/(:num)', 'fluxbb::home@forum');
Route::get('(:bundle)/topic/(:num)', 'fluxbb::home@topic');
Route::get('(:bundle)/post/(:num)', 'fluxbb::home@post');
Route::get('(:bundle)', 'fluxbb::home@index');
Route::get('(:bundle)/profile/(:num)', "fluxbb::user@profile");