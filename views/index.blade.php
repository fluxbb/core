@extends('fluxbb::layout.main')

@section('main')

<!-- begin board wrapper -->
<div id="brdwrapper">

    <div id="idx1" class="idx">

        <h2 class="category-title">{{ $category->name }}</h2>

        @if ($categories)
            @include('fluxbb::categories.list')
        @endif

        @if ($conversations)
            @include('fluxbb::conversations.list')
        @endif

    </div>

</div>
<!-- end board wrapper -->

@stop
