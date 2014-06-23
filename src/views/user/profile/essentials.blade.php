@extends('fluxbb::layout.main')

@section('main')

<div id="profile" class="profile row clearfix">

    <div class="col-md-3">
        <div class="profile-widget text-center">
            <div class="profile-avatar">
                <img src="assets/img/roxane.jpg" alt="" />
            </div>
            <div class="profile-details">
                <div class="profile-username"><h3>Roxane</h3></div>
                <div class="profile-fullname"><h5>Magdeleine Robin</h5></div>
                <div class="profile-contact"><a class="btn btn-success" href="#">Contact</a></div>
            </div>
            <div class="profile-stats row">
                <div class="profile-posts col-md-6"><a href="#"><h4>2,632 <small>Posts</small></h4></a></div>
                <div class="profile-topics col-md-6"><a href="#"><h4>48 <small>Topics</small></h4></a></div>
            </div>
        </div>
    </div>

    <div class="col-md-9">

        <div class="profile-full col-md-12 clearfix">

            <div class="profile-title">
                <h4>
                    <span>Précieuse</span> <span class="profile-registered">Since March 6, 1619</span>
                    <span class="profile-links pull-right">
                        <a class="tip btn profile-website" href="#" data-original-title="https://en.wikipedia.org/wiki/Cyrano_de_Bergerac_(play)"></a>
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
                    <blockquote><p>Magdeleine Robin − Roxane, so called! A subtle wit, a <em>précieuse</em>. Count de Guiche quite enamored of me, but wedded he is, to the niece of Armand de Richelieu. Would fain marry me to a certain sorry fellow, one Monsieur de Valvert, a viscount − and − accommodating! I will none of that bargain.</p></blockquote>
                </div>
                <div id="profile-signature" class="profile-pane tab-pane">
                    <blockquote><p>« <em>Far from this world of brutal lies is a land for lovers who despise violence, weeping for the lost and lonely. A land for lovers, for lovers only.</em> »</p></blockquote>
                </div>
            </div>

        </div>

        <div class="profile-message col-md-12 clearfix">
            <div class="profile-message-avatar col-md-2">
                <img src="assets/img/cyrano.jpg" alt="" />
            </div>
            <div class="profile-message-content col-md-10">
                <textarea placeholder="Write a private message to Roxane"></textarea>
            </div>
        </div>

        <div class="profile-latest-posts col-md-12 clearfix">

            <div class="latest-post-timeline"></div>

            <div class="latest-post col-md-6 pull-left">
                <i class="latest-post-timedot"></i>
                <div class="latest-post-meta clearfix">
                    <div class="latest-post-topic pull-left"><h5>Posted in <a href="#">FluxBB Redefined</a></h5></div>
                    <span class="latest-post-date pull-right"><a href="#">2013-10-26</a></span>
                </div>
                <div class="latest-post-message">Ah! methinks 'twere impossible that there could breathe a man on this earth skilled to say as sweetly as he all the pretty nothings…</div>
            </div>

            <div class="latest-post col-md-6 pull-right">
                <i class="latest-post-timedot"></i>
                <div class="latest-post-meta clearfix">
                    <div class="latest-post-topic pull-left"><h5>Posted in <a href="#">FluxBB Redefined</a></h5></div>
                    <span class="latest-post-date pull-right"><a href="#">2013-10-26</a></span>
                </div>
                <div class="latest-post-message">…that mean so much…</div>
            </div>

            <div class="latest-post col-md-6 pull-right">
                <i class="latest-post-timedot"></i>
                <div class="latest-post-meta clearfix">
                    <div class="latest-post-topic pull-left"><h5>Posted in <a href="#">FluxBB Redefined</a></h5></div>
                    <span class="latest-post-date pull-right"><a href="#">2013-10-25</a></span>
                </div>
                <div class="latest-post-message">That mean all! At times his mind seems far away, the Muse says naught - and then, presto! he speaks - bewitchingly! enchantingly!</div>
            </div>

            <div class="latest-post col-md-6 pull-left">
                <i class="latest-post-timedot"></i>
                <div class="latest-post-meta clearfix">
                    <div class="latest-post-topic pull-left"><h5>Posted in <a href="#">FluxBB Redefined</a></h5></div>
                    <span class="latest-post-date pull-right"><a href="#">2013-10-24</a></span>
                </div>
                <div class="latest-post-message">Ah! methinks 'twere impossible that there could breathe a man on this earth…</div>
            </div>

            <div class="latest-post col-md-6 pull-right">
                <i class="latest-post-timedot"></i>
                <div class="latest-post-meta clearfix">
                    <div class="latest-post-topic pull-left"><h5>Posted in <a href="#">FluxBB Redefined</a></h5></div>
                    <span class="latest-post-date pull-right"><a href="#">2013-10-26</a></span>
                </div>
                <div class="latest-post-message">Ah! methinks 'twere impossible that there could breathe a man on this earth skilled to say as sweetly as he all the pretty nothings…</div>
            </div>

            <div class="latest-post col-md-6 pull-left">
                <i class="latest-post-timedot"></i>
                <div class="latest-post-meta clearfix">
                    <div class="latest-post-topic pull-left"><h5>Posted in <a href="#">FluxBB Redefined</a></h5></div>
                    <span class="latest-post-date pull-right"><a href="#">2013-10-24</a></span>
                </div>
                <div class="latest-post-message">Ah! methinks 'twere impossible that there could breathe a man on this earth skilled to say as sweetly as he all the pretty nothings, that mean so much, That mean all! At times his mind seems far away, the Muse says naught - and then, presto! he speaks - bewitchingly! enchantingly!</div>
            </div>

        </div>

        <div class="profile-history col-md-6 clearfix">
            <div class="profile-history-timeline col-md-3"><div class="bar"></div></div>
            <div class="profile-history-events col-md-12 clearfix">
                <div class="profile-history-marker col-md-3">
                    <div class="profile-history-date col-md-8">1640-12-03</div>
                    <div class="profile-history-dot col-md-4"><i class="icon-graduation-cap"></i></div>
                </div>
                <div class="profile-history-event col-md-9">
                    <h5>Joined the Administrator Group</h5>
                </div>
            </div>
            <div class="profile-history-events col-md-12 clearfix">
                <div class="profile-history-marker col-md-3">
                    <div class="profile-history-date col-md-8">1639-10-30</div>
                    <div class="profile-history-dot col-md-4"><i class="icon-trophy"></i></div>
                </div>
                <div class="profile-history-event col-md-9">
                    <h5>1000<sup>th</sup> rhyme posted</h5>
                </div>
            </div>
            <div class="profile-history-events col-md-12 clearfix">
                <div class="profile-history-marker col-md-3">
                    <div class="profile-history-date col-md-8">1638-09-17</div>
                    <div class="profile-history-dot col-md-4"><i class="icon-star"></i></div>
                </div>
                <div class="profile-history-event col-md-9">
                    <h5>Joined the Moderator Group</h5>
                </div>
            </div>
            <div class="profile-history-events col-md-12 clearfix">
                <div class="profile-history-marker col-md-3">
                    <div class="profile-history-date col-md-8">1638-04-02</div>
                    <div class="profile-history-dot col-md-4"><i class="icon-trophy"></i></div>
                </div>
                <div class="profile-history-event col-md-9">
                    <h5>100<sup>th</sup> rhyme posted</h5>
                </div>
            </div>
            <div class="profile-history-events col-md-12 clearfix">
                <div class="profile-history-marker col-md-3">
                    <div class="profile-history-date col-md-8">1638-01-24</div>
                    <div class="profile-history-dot col-md-4"><i class="icon-user"></i></div>
                </div>
                <div class="profile-history-event col-md-9">
                    <h5>Joined the Play</h5>
                </div>
            </div>
            <div class="profile-history-events col-md-12 clearfix">
                <div class="profile-history-marker col-md-3">
                    <div class="profile-history-date col-md-8">1622-08-14</div>
                    <div class="profile-history-dot col-md-4"><i class="icon-clock"></i></div>
                </div>
                <div class="profile-history-event col-md-9">
                    <h5>Birth in Bergerac</h5>
                </div>
            </div>
        </div>

        <div class="profile-map col-md-6">
            <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://www.openstreetmap.org/export/embed.html?bbox=-7.536621093749999%2C38.47939467327645%2C8.50341796875%2C50.583236614805905&amp;layer=transportmap&amp;marker=44.84029065139799%2C0.4833984375"></iframe>
        </div>

    </div>

</div>

@stop
