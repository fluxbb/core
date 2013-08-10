<!DOCTYPE html>

<html lang="en" dir="ltr">

	<head>

		<meta charset="utf-8">

		<title>FluxBB | Administration</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" href="{{ URL::asset('packages/fluxbb/core/css/bootstrap-fluxbb.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('packages/fluxbb/core/css/morris.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('packages/fluxbb/core/css/font-awesome.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('packages/fluxbb/core/css/main.css') }}">

		<link rel="shortcut icon" href="{{ URL::asset('packages/fluxbb/core/img/favicon.ico') }}">

	</head>

	<body>

		@include('fluxbb::admin.layout.menu')
		

		@yield('alerts')

		@yield('main')


		<footer class="footer">

			<div class="container">

				<p class="muted pull-right">FluxBB 2.0a2 &copy; <a href="http://fluxbb.org" target="_blank">FluxBB</a> 2013</p>

			</div>

		</footer>

		<script src="{{ URL::asset('packages/fluxbb/core/js/jquery-1.9.1.min.js') }}"></script>
		<script src="{{ URL::asset('packages/fluxbb/core/js/raphael.min.js') }}"></script>
		<script src="{{ URL::asset('packages/fluxbb/core/js/morris.min.js') }}"></script>
		<script src="{{ URL::asset('packages/fluxbb/core/js/bootstrap.min.js') }}"></script>
		<script src="{{ URL::asset('packages/fluxbb/core/js/application.js') }}"></script>

	</body>

</html>