<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>FluxBB</title>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('packages/fluxbb/core/css/style.css') }}" />
	<script type="text/javascript" src="{{ URL::asset('packages/fluxbb/core/js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('packages/fluxbb/core/js/admin.js') }}"></script>
</head>

<body>
	<div class="headercontainer">
		@include('fluxbb::admin.layout.header')
	</div>
	<div class="container">
		<div class="sidebar">
			@include('fluxbb::admin.layout.menu')
		</div>
		<div class="content">
			@yield('alerts')

			@yield('main')
		</div>
	</div>
	<div class="footer">
		<p>2013 &copy; FluxBB - GPLv3</p>
		<p id="right"><a href="#">Version 2.0a2</a> - <a href="http://fluxbb.org">Support</a></p>
	</div>
</body>
</html>