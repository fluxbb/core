@extends('fluxbb::layout.main')

@section('main')

<!-- begin board wrapper -->
<div id="brdwrapper">

    <div id="idx1" class="idx">

        <h2 class="category-title">{{ $category->name }}</h2>

        @if ($categories)
            @include('fluxbb::categories.list')
        @endif

        @include('fluxbb::conversations.list')

        <a href="{{ $route('new_topic', ['slug' => $category->slug]) }}">New topic</a>

    </div>

</div>
<!-- end board wrapper -->

@stop
