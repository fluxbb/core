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

Autoloader::namespaces(array(
	'fluxbb' => __DIR__ . DS . 'models',
));

Autoloader::underscored(array(
	'FluxBB' => __DIR__ . DS . 'classes',
));


/**
 * VIEW COMPOSERS
 */
View::composer('fluxbb::layout.main', function($view)
{
	$view->with('language', 'en')
		->with('direction', 'ltr')
		->with('head', '')
		->with('page', 'index')
		->with('title', 'My FluxBB Forum')
		->with('desc', '<p><span>Unfortunately no one can be told what FluxBB is - you have to see it for yourself.</span></p>')
		->with('navlinks', '<ul><li><a href="#">Home</a></li></ul>')
		->with('status', 'You are not logged in.')
		->with('announcement', '');
});

// TODO: Maybe too generic a place for this
View::composer('fluxbb::auth.login', function($view)
{
	// TODO: Might want to make this dynamic
	$redirect_url = URL::to_action('fluxbb::home@index');
	$view->with('redirect_url', $redirect_url);
});


// Route filters
require 'helpers/filters.php';

// HTML helpers
require 'helpers/html.php';
