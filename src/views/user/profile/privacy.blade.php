@extends('fluxbb::layout.main')

@section('main')
<?php $currentItem = 'Privacy'; ?>

<div id="profile" class="block2col">
    @include('fluxbb::user.profile.menu')
    <div class="blockform">
        <h2><span>{{ trans('fluxbb::profile.section_privacy') }}</span></h2>
        <div class="box">
            <form id="profile6" method="post">
                <div class="inform">
                    <fieldset>
                        <legend>{{ trans('fluxbb::profile.options_legend') }}</legend>
                        <div class="infldset">
                            <input type="hidden" name="form_sent" value="1">
                            <p>{{ trans('fluxbb::profile.options_info') }}</p>
                            <div class="rbox">
                                <label><input type="radio" name="form[email_setting]" value="0"> {{ trans('fluxbb::profile.email_settings_1') }}<br></label>
                                <label><input type="radio" name="form[email_setting]" value="1" checked="checked"> {{ trans('fluxbb::profile.email_settings_2') }}<br></label>
                                <label><input type="radio" name="form[email_setting]" value="2"> {{ trans('fluxbb::profile.email_settings_3') }}<br></label>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="inform">
                    <fieldset>
                        <legend>{{ trans('fluxbb::profile.subscription_legend') }}</legend>
                        <div class="infldset">
                            <div class="rbox">
                                <label><input type="checkbox" name="form[notify_with_post]" value="1"> {{ trans('fluxbb::profile.notify_full') }}<br></label>
                                <label><input type="checkbox" name="form[auto_notify]" value="1"> {{ trans('fluxbb::profile.auto_notify_full') }}<br></label>
                            </div>
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
