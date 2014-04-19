@include('fluxbb::layout.partials.header')

<div id="brdmain">

@if (isset($message))
    <div class="alert alert-info">
        {{{ $message }}}
    </div>
@endif

@yield('main')

</div>

@include('fluxbb::layout.partials.footer')
