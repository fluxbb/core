@extends('fluxbb::layout.main')

@section('main')

<div id="vt" class="vtx">

    <h2 class="topic-title"><span>{{ $topic->title }}</span></h2>

    <div class="top-navigation clearfix">
        <ul class="pagination pagelink pull-left">
            <li class="disabled"><a><span class="pages-label">Pages: </span></a></li>
            <li class="disabled"><a><strong class="item1">1</strong></a></li>
            <li><a href="viewforum.html">2</a></li>
        </ul>
    </div>

    @include('fluxbb::posts.list')

    <div id="brdbottom">
        <div class="inbox">
            <div class="pagepost clearfix">
                <ul class="pagination pagelink pull-left">
                    <li class="disabled"><a><span class="pages-label">Pages: </span></a></li>
                    <li class="disabled"><a><strong class="item1">1</strong></a></li>
                    <li><a href="viewforum.html">2</a></li>
                </ul>
            </div>
        </div>
    </div>

</div>

<div id="quickpost" class="post post-bg clearfix">
    <form action="{{ $route('reply_handler', array('id' => $topic->id)) }}" method="POST">
        <div class="author-box col-md-2 col-sm-2 col-xs-2">
            <div class="author-name"><h4>Reply</h4></div>
        </div>
        <div class="post-box col-md-10 col-sm-10 col-xs-10">
            <div class="post-content">
                <textarea name="req_message" class="new-message" rows="7" cols="75" placeholder="Write your message and submit!"></textarea>
            </div>
        </div>
        <div class="new-post-submit col-md-offset-2">
            <div class="post-options pull-left">
                <span class="label label-success">BBCode</a></span>
                <span class="label label-success">[url] tag</a></span>
                <span class="label label-danger">[img] tag</a></span>
                <span class="label label-success">Smilies</a></span>
            </div>
            <input class="btn btn-success pull-right" type="submit" value="Submit" />
        </div>
    </form>
</div>

@stop
