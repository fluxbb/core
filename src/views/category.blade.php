@extends('fluxbb::layout.main')

@section('main')

<!-- begin board wrapper -->
<div id="brdwrapper">

    <div id="idx1" class="idx">

        <h2 class="category-title">{{ $category->name }}</h2>

        @if ($categories)
            @include('fluxbb::categories.list')
        @endif

    </div>

    <!-- begin board top -->
    <div id="brdtop">

        <div class="inbox clearfix">

            <!-- TODO: pagination -->
            <div class="pagepost clearfix">

                <ul class="pagination pagelink pull-left">
                    <li class="disabled"><a href="#"><span class="pages-label">Pages: </span></a></li>
                    <li class="disabled"><a href="#"><strong class="item1">1</strong></a></li>
                    <li><a href="viewforum.html">2</a></li>
                    <li><a href="viewforum.html">3</a></li>
                    <li class="disabled"><a href="#"><span class="spacer">…</span></a></li>
                    <li><a href="viewforum.html">5</a></li>
                    <li><a rel="next" href="viewforum.html">Next</a></li>
                </ul>

                <div class="btn-group postlink pull-right">
                    <a class="btn btn-default subscribe" href="#"><span>Subscribe</span></a>
                    <a class="btn btn-default markread" href="#"><span>Mark as read</span></a>
                    <a class="btn btn-primary post-new" href="{{ $route('new_topic', ['slug' => $category->slug]) }}"><span>{{ trans('fluxbb::forum.post_topic') }}</span></a>
                </div>

            </div>

        </div>

    </div>
    <!-- end board top -->

    <div id="vf" class="vfx">

        @include('fluxbb::conversations.list')

    </div>

</div>
<!-- end board wrapper -->

@stop
