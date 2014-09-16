@include('fluxbb::layout.partials.header')

<div id="brdmain">

@if (isset($message))
    <script type="text/javascript">
        jQuery(function($) {
            var message = {{ json_encode($message) }};
            FluxBB.alert(message);
        });
    </script>
    <div class="alert alert-info" id="alert-message"></div>
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
