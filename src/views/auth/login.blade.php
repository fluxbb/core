@extends('fluxbb::layout.main')

@section('main')
<h2>{{ trans('fluxbb::common.login') }}</h2>
<form id="login" method="post" action="{{ route('login') }}" onsubmit="return process_form(this)">
    <fieldset>
        <legend>{{ trans('fluxbb::login.login_legend') }}</legend>
        <input type="hidden" name="form_sent" value="1" />
        <input type="hidden" name="redirect_url" value="{{ isset($redirect_url) ? $redirect_url : '' }}" />
        <label class="conl required"><strong>{{ trans('fluxbb::common.username') }} <span>{{ trans('fluxbb::common.required') }}</span></strong><br /><input type="text" name="req_username" size="25" maxlength="25" tabindex="1" /><br /></label>
        <label class="conl required"><strong>{{ trans('fluxbb::common.password') }} <span>{{ trans('fluxbb::common.required') }}</span></strong><br /><input type="password" name="req_password" size="25" tabindex="2" /><br /></label>

        <div class="rbox clearb">
            <label><input type="checkbox" name="save_pass" value="1" tabindex="3" />{{ trans('fluxbb::login.remember_me') }}<br /></label>
        </div>

        <p class="clearb">{{ trans('fluxbb::login.info') }}</p>
        <p class="actions"><span><a href="{{ route('register') }}" tabindex="5">{{ trans('fluxbb::login.not_registered') }}</a></span> <span><a href="{{ route('forgot_password') }}" tabindex="6">{{ trans('fluxbb::login.forgotten_pass') }}</a></span></p>
    </fieldset>
    <p class="buttons"><input type="submit" name="login" value="{{ trans('fluxbb::common.login') }}" tabindex="4" /></p>
</form>
@stop
