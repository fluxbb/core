@include('fluxbb::partials.header')

<div id="brdmain">

@if (isset($errors) and $errors->has())
	<div class="alert alert-danger">
		<p>The following errors occured:</p>
		<ul>
		@foreach ($errors->all('<li>:message</li>') as $error)
			{{ $error }}
		@endforeach
		</ul>
	</div>
@endif

@yield('main')

</div>

@include('fluxbb::partials.footer')
