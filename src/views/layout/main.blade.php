@include('fluxbb::layout.partials.header')

<div id="brdmain">

@if (isset($message))
    <div class="alert alert-info">
        {{{ $message }}}
    </div>
@endif

@if ($errors->has())
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

@include('fluxbb::layout.partials.footer')
