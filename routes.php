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

Route::get('(:bundle)/forum/(:num)', 'fluxbb::home@forum');
Route::get('(:bundle)/topic/(:num)', 'fluxbb::home@topic');
Route::get('(:bundle)/post/(:num)', 'fluxbb::home@post');
Route::get('(:bundle)', 'fluxbb::home@index');
Route::get('(:bundle)/profile/(:num)/(:any?)', 'fluxbb::user@profile');
Route::get('(:bundle)/user/list', "fluxbb::user@list");
Route::get('(:bundle)/search', "fluxbb::search@index");