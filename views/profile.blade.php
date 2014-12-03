@extends('fluxbb::layout.main')

@section('main')

<div id="profile" class="profile row clearfix">

    <div class="col-md-3">
        <div class="profile-widget text-center">
            <div class="profile-avatar">
                <img src="assets/img/roxane.jpg" alt="" />
            </div>
            <div class="profile-details">
                <div class="profile-username"><h3>{{{ $user->username }}}</h3></div>
                <div class="profile-fullname"><h5>{{{ $user->realname }}}</h5></div>
                <div class="profile-contact"><a class="btn btn-success" href="#">Contact</a></div>
            </div>
            <div class="profile-stats row">
                <div class="profile-posts col-md-6"><a href="#"><h4>{{ $user->num_posts }} <small>Posts</small></h4></a></div>
                <div class="profile-topics col-md-6"><a href="#"><h4>{{ $user->num_topics }} <small>Topics</small></h4></a></div>
            </div>
        </div>
    </div>

    <div class="col-md-9">

        <div class="profile-full col-md-12 clearfix">

            <div class="profile-title">
                <h4>
                    <span>Member</span> <span class="profile-registered">Since March 6, 1619</span>
                    <span class="profile-links pull-right">
                        <a class="tip btn profile-website" href="#" data-original-title="Website"></a>
                        <a class="tip btn profile-facebook" href="#" data-original-title="Facebook"></a>
                        <a class="tip btn profile-twitter" href="#" data-original-title="Twitter"></a>
                        <a class="tip btn profile-googleplus" href="#" data-original-title="Google+"></a>
                    </span>
                </h4>
                <span class="label label-default">Offline</span>
                <span class="profile-last-visit">Latest activity today, 01:54</span>
            </div>

            <ul class="nav nav-tabs profile-tabs">
                <li class="active"><a id="tab-biography" href="#profile-biography" data-toggle="tab"></a></li>
                <li><a id="tab-signature" href="#profile-signature" data-toggle="tab"></a></li>
            </ul>

            <div class="tab-content profile-content">
                <div id="profile-biography" class="profile-pane tab-pane active">
                    <blockquote><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam rhoncus felis varius, fermentum risus id, laoreet ex.</p></blockquote>
                </div>
                <div id="profile-signature" class="profile-pane tab-pane">
                    <blockquote><p>« <em>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam rhoncus felis varius, fermentum risus id, laoreet ex.</em> »</p></blockquote>
                </div>
            </div>

        </div>

    </div>

</div>

@stop
