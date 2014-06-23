@extends('fluxbb::layout.main')

@section('main')


<!-- begin board main -->
<div id="brdmain">

    <!-- begin board top -->
    <div id="brdtop">

        <div class="inbox clearfix">

            <ul class="breadcrumb">
                <li><a href="{{ URL::route('index') }}">Index</a></li>
                <li><strong><a href="viewforum.html"><!-- TODO: $category->cat_name -->Category</a></strong></li>
                <li><strong><a href="viewforum.html">{{ $forum->forum_name }}</a></strong></li>
            </ul>

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
                    <a class="btn btn-default suscribe" href="#"><span>Suscribe</span></a>
                    <a class="btn btn-default markread" href="#"><span>Mark as read</span></a>
                    <a class="btn btn-primary post-new" href="{{ route('new_topic', array('id' => $forum->id)) }}"><span>{{ trans('fluxbb::forum.post_topic') }}</span></a>
                </div>

            </div>

        </div>

    </div>
    <!-- end board top -->

    <div id="vf" class="vfx">

    <h2 class="forum-title"><span>{{ $forum->forum_name }}</span></h2>

    <div class="row vfx-header">
        <div class="col-md-6 col-sm-6 col-xs-6">Topic</div>
        <div class="col-md-1 col-sm-1 col-xs-1">{{ trans('fluxbb::common.replies') }}</div>
        <div class="col-md-1 col-sm-1 col-xs-1">{{ trans('fluxbb::forum.views') }}</div>
        <div class="col-md-4 col-sm-4 col-xs-4">{{ trans('fluxbb::common.last_post') }}</div>
    </div>

    <!-- TODO: stickies -->

    <!-- TODO: Icons -->

<?php $topic_count = 0; ?>
@foreach ($forum->topics as $topic)
<?php

$topic_count++;
$icon_type = 'icon';
if (FluxBB\Models\User::current()->isMember() && $topic->last_post > FluxBB\Models\User::current()->last_visit && (!isset($tracked_topics['topics'][$topic->id]) || $tracked_topics['topics'][$topic->id] < $topic->last_post) && (!isset($tracked_topics['forums'][$forum->id]) || $tracked_topics['forums'][$forum->id] < $topic->last_post) && is_null($topic->moved_to))
{
    // TODO: For obvious reasons, this if statement should not be here in the view (in that form)
    $icon_type = 'icon icon-new';
}

?>
    <div class="row vfx-content">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <a href="{{ route('viewtopic', array('id' => $topic->id)) }}">{{ ($topic->subject) }}</a> {{ trans('fluxbb::common.by', array('author' => ($topic->poster))) }}
        </div>
        <div class="col-md-1 col-sm-1 col-xs-1">{{ $topic->numReplies() }}</div>
        <div class="col-md-1 col-sm-1 col-xs-1">{{ $topic->numViews() }}</div> <!-- TODO: Only show if o_topic_views is enabled -->
        <div class="col-md-4 col-sm-4 col-xs-4">
    @if ($topic->wasMoved())
            - - -
    @else
            <!-- TODO: Pass $last_post instead of $topic to url() -->
            <a href="{{ route('viewpost', array('id' => $topic->id)) }}#p{{ $topic->last_post_id }}">{{ HTML::format_time($topic->last_post) }}</a> <span class="byuser">{{ trans('fluxbb::common.by', array('author' => ($topic->last_poster))) }}</span>
    @endif
        </div>
    </div>
@endforeach

</div>
<!-- end board main -->

<a href="{{ route('new_topic', array('id' => $forum->id)) }}">{{ trans('fluxbb::forum.post_topic') }}</a>

@stop
