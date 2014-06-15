@extends('fluxbb::layout.main')

@section('main')

<div id="profile" class="block2col">
    @include('fluxbb::user.profile.menu')
    <div class="blockform">
        <h2><span>{{ trans('fluxbb::profile.section_personality') }}</span></h2>
        <div class="box">
            <form method="post" action="{{ route('profile', array('id' => $user->id, 'action' => 'personality')) }}">
                <div class="inform">
                    <fieldset id="profileavatar">
                        <legend>{{ trans('fluxbb::profile.avatar_legend') }}</legend>
                        <div class="infldset">
                            <p>{{ trans('fluxbb::profile.avatar_info') }}</p>
                            <p class="clearb actions"><span><a href="profile.php?action=upload_avatar&amp;id=3">{{ trans('fluxbb::profile.upload_avatar') }}</a></span></p>
                        </div>
                    </fieldset>
                </div>
                <div class="inform">
                    <fieldset>
                        <legend>{{ trans('fluxbb::profile.signature_legend') }}</legend>
                        <div class="infldset">
                            <p>{{ trans('fluxbb::profile.signature_info') }}</p>
                            <div class="txtarea">
                                <label>Max length: 400 characters / Max lines: 4<br>
                                <textarea name="signature" rows="4" cols="65"></textarea><br></label>
                            </div>
                            <ul class="bblinks">
                                <?php //TODO: all these links ?>
                                <li><span><a href="help.php#bbcode" onclick="window.open(this.href); return false;">{{ trans('fluxbb::common.bbcode') }}</a> {{ trans('fluxbb::common.on') }}</span></li>
                                <li><span><a href="help.php#url" onclick="window.open(this.href); return false;">{{ trans('fluxbb::common.url_tag') }}</a> {{ trans('fluxbb::common.on') }}</span>
                                </li><li><span><a href="help.php#img" onclick="window.open(this.href); return false;">{{ trans('fluxbb::common.img_tag') }}</a> {{ trans('fluxbb::common.off') }}</span></li>
                                <li><span><a href="help.php#smilies" onclick="window.open(this.href); return false;">{{ trans('fluxbb::common.smilies') }}</a> {{ trans('fluxbb::common.on') }}</span></li>
                            </ul>
                            <p>{{ trans('fluxbb::profile.no_sig') }}</p>
                        </div>
                    </fieldset>
                </div>
                <p class="buttons"><input type="submit" name="update" value="{{ trans('fluxbb::common.submit') }}"> {{ trans('fluxbb::profile.instructions') }}</p>
            </form>
        </div>
    </div>
    <div class="clearer"></div>
</div>
@stop
