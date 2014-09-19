<div class="row idx-header">
    <div class="col-md-6 col-sm-6 col-xs-6">Forum</div>
    <div class="col-md-1 col-sm-1 col-xs-1">Topics</div>
    <div class="col-md-1 col-sm-1 col-xs-1">Posts</div>
    <div class="col-md-4 col-sm-4 col-xs-4">Last post</div>
</div>

@foreach ($categories as $category)
<div class="row idx-content">
    <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="idx-icon idx-icon-read pull-left"></div>
            <div class="tclcon">
                <h4 class="forum-title"><a href="{{ $route('viewforum', array('id' => $category->slug)) }}">{{ $category->name }}</a></h4>
                <div class="forum-description">{{ 'A description' }}</div>
                <p class="moderator-list">(<em>Moderated by</em> <a href="#">Eric</a>, <a href="#">Eric</a>)</p>
            </div>
    </div>
    <div class="forum-topics col-md-1 col-sm-1 col-xs-1">0</div>
    <div class="forum-views col-md-1 col-sm-1 col-xs-1">0</div>
    <div class="forum-date col-md-4 col-sm-4 col-xs-4"><a href="viewtopic.html">2013-08-18 01:00:04</a> <span class="byuser">by Cyrano</span></div>
</div>
@endforeach
