@extends('fluxbb::layout.main')

@section('main')

<div id="vt" class="vtx">

    <form action="{{ $route('new_topic', ['slug' => $category->slug]) }}" method="POST" id="post">

        <div class="topic-title new-topic-title">
            <input type="text" name="subject" value="" placeholder="Give your conversation a title." />
        </div>

        <div id="post-new" class="post post-new post-bg clearfix">
            <div class="author-box col-md-2 text-center">
                <div class="author-name"><h4><a href="#">Username</a></h4></div>
                <div class="author-avatar"><img src="assets/img/cyrano.jpg" width="140" height="140" alt="" /></div>
            </div>
            <div class="post-box col-md-10">
                <div class="post-meta clearfix">
                    <div class="pull-left"><a href="#">2013-10-29 23:18:38</a></div>
                    <div class="pull-right">#1</div>
                </div>
                <div class="post-content new-post-content">
                    <a id="edit-post" href="#"><i class="icon-keyboard icon-2x"></i></a>
                    <a id="preview-post" href="#"><i class="icon-eye icon-2x"></i></a>
                    <textarea class="new-topic-message" name="message" id="message" cols="95" rows="12"></textarea>
                    <div class="new-topic-preview"></div>
                </div>
                <div class="post-footer">
                    <div class="col-md-8">
                        <div class="checkbox"><label><input type="checkbox" value="" />Never show smilies as icons for this post</label></div>
                        <div class="checkbox"><label><input type="checkbox" value="" />Subscribe to this topic</label></div>
                    </div>
                    <div class="text-right col-md-4">
                        <input class="btn btn-danger delete-topic" type="submit" value="Trash" />
                        <input class="btn btn-warning save-topic" type="submit" value="Save" />
                        <input class="btn btn-success submit-topic" type="submit" value="Submit" />
                    </div>
                </div>
            </div>
        </div>

    </form>

</div>

@stop
