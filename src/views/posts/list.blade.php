@foreach ($posts as $post)
    <div id="p{{ $post->id }}" class="post post-bg clearfix">
        <div class="author-box col-md-2 col-sm-2 col-xs-2">
            <div class="author-name"><h4><a href="{{ $route('profile', ['id' => $post->poster_id]) }}">{{ $post->poster }}</a></h4></div>
            <div class="author-title"><h5>{{ 'Administrator' }}</h5></div>
            <div class="author-avatar"><img src="assets/img/cyrano.jpg" width="70" height="80" alt=""></div>
            <div class="author-icon author-location"><a href="#" class="tip author-field" data-original-title="Location: Bergerac"></a></div>
            <div class="author-icon author-registered"><a href="#" class="tip author-field" data-original-title="Member since: 1619-03-06"></a></div>
            <div class="author-icon author-posts"><a href="#" class="tip author-field" data-original-title="4,815 Posts"></a></div>
            <div class="author-icon author-ip"><a href="#" class="tip author-field" data-original-title="IP: 127.0.0.1"></a></div>
            <div class="author-icon author-email"><a href="#" class="tip author-field" data-original-title="Email: "></a></div>
            <div class="author-icon author-website"><a href="#" class="tip author-field" data-original-title="Website: " rel="nofollow"></a></div>
        </div>
        <div class="post-box col-md-10 col-sm-10 col-xs-10">
            <div class="post-meta clearfix">
                <div class="pull-left">
                    <a href="{{ $route('viewpost', ['id' => $post->id]) }}#p{{ $post->id }}">{{ $post->posted }}</a>
                </div>
                <div class="pull-right">#7</div>
            </div>
            <div class="post-content">
                <p>{{ $post->message }}</p>
            </div>
            <div class="post-footer">
                <div class="post-menu pull-right col-md-2 col-sm-2 col-xs-2">
                    <a href="{{ $route('post_report', ['id' => $post->id]) }}" class="tip btn post-report" data-placement="top" title="Report this post" data-original-title="Report this post"></a>
                    <a href="{{ $route('post_delete', ['id' => $post->id]) }}" class="tip btn post-delete" data-placement="top" title="" data-original-title="Delete this post"></a>
                    <a href="{{ $route('post_quote', ['id' => $post->id]) }}" class="tip btn post-quote" data-placement="top" title="" data-original-title="Quote this post"></a>
                </div>
            </div>
        </div>
    </div>
@endforeach
