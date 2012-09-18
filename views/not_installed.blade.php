<!doctype html>

<html>
<head>
	<title>FluxBB</title>
</head>

<body>

	<h1>Not installed</h1>
	<p>It looks like FluxBB has not been installed yet.</p>
@if ($has_installer)
	<p>Please visit {{ HTML::link_to_action('fluxbb_installer::home@start') }} to install the software.</p>
@else
	<p>As you do not seem to have the graphical installer in your system, you can install FluxBB by running the following commands from the command line:</p>
<pre>
php artisan fluxbb::install:config
php artisan fluxbb::install:structure
php artisan fluxbb::install:seed
</pre>
@endif

</body>

</html>