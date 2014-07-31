@extends('fluxbb::layout.main')

@section('main')


@foreach ($categories as $cat_info)

<!-- begin board wrapper -->
<div id="brdwrapper">

    <div id="idx1" class="idx">

    <?php $category = $cat_info['category']; ?>
    <h2 class="category-title">{{ $category->cat_name }}<a id="idxpend-1" class="idxpend pull-right" href="#"><span class="xpend"></span></a></h2>

    <div class="row idx-header">
        <div class="col-md-6 col-sm-6 col-xs-6">Forum</div>
        <div class="col-md-1 col-sm-1 col-xs-1">Topics</div>
        <div class="col-md-1 col-sm-1 col-xs-1">Posts</div>
        <div class="col-md-4 col-sm-4 col-xs-4">Last post</div>
    </div>

    @foreach ($cat_info['forums'] as $forum)
    <div class="row idx-content">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="idx-icon idx-icon-read pull-left"></div>
                <div class="tclcon">
                    <h4 class="forum-title"><a href="{{ $route('viewforum', array('id' => $forum->id)) }}">{{ $forum->forum_name }}</a></h4>
                    <div class="forum-description">{{ $forum->forum_desc }}</div>
                    <p class="moderator-list">(<em>Moderated by</em> <a href="#">Eric</a>, <a href="#">Eric</a>)</p>
                </div>
        </div>
        <div class="forum-topics col-md-1 col-sm-1 col-xs-1">{{ $forum->numTopics() }}</div>
        <div class="forum-views col-md-1 col-sm-1 col-xs-1">{{ $forum->numPosts() }}</div>
        <div class="forum-date col-md-4 col-sm-4 col-xs-4"><a href="viewtopic.html">2013-08-18 01:00:04</a> <span class="byuser">by Cyrano</span></div>
    </div>
    @endforeach

    </div>

</div>
<!-- end board wrapper -->

@endforeach


<!-- begin board stats -->
<div id="brdstats" class="clearfix">
    <div class="box">
        <div class="users-online col-xs-12 col-sm-12 col-md-6 pull-left">
            <h5> Active Users</h5>
            <p>
                <span>There are currently 1 user online.</span>
                <span>1 Member and 0 Guest</span>
                <br>
                <span class="online">Online:</span> <span><a href="edit-profile.html">Cyrano</a></span>
            </p>
        </div>
        <div class="forum-stats col-xs-12 col-sm-12 col-md-6 pull-right text-right">
            <h5><span></span> FluxBB Forum Statistics</h5>
            <p>
                <span>Threads: <strong>2</strong></span>
                <span>Posts: <strong>76</strong></span>
                <span>Members: <strong>246</strong></span>
                <br>
                <span>Welcome to our newest member, <a href="profile.html">Roxane</a></span>
            </p>
        </div>
    </div>
</div>
<!-- end board stats -->

@stop
