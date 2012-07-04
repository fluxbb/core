<?php

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
require('helpers/html.php'); //include html helpers