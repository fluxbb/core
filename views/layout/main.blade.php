<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{{ $language }}" lang="{{ $language }}" dir="{{ $direction }}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{{ HTML::style('css/themes/Air/base_admin.css') }}
{{ HTML::style('css/themes/Air/Air.css') }}
{{ $head }}
</head>

<body>

<div id="pun{{ $page }}" class="pun">
<div class="top-box"><div><!-- Top Corners --></div></div>
<div class="punwrap">

<div id="brdheader" class="block">
	<div class="box">
		<div id="brdtitle" class="inbox">
			{{ $title }}
			{{ $desc }}
		</div>
		{{ $navlinks }}
		{{ $status }}
	</div>
</div>

{{ $announcement }}

<div id="brdmain">
@yield('main')
</div>

@include('fluxbb::layout.partials.footer')

</div>
<div class="end-box"><div><!-- Bottom corners --></div></div>
</div>

</body>
</html>
