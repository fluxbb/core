@extends('fluxbb::layout.main')

@section('main')
<h2>{{ trans('fluxbb::register.register') }}</h2>
<form id="register" method="post" action="{{ $route('register') }}">
    <fieldset>
        <legend>{{ trans('fluxbb::register.legend_username') }}</legend>
        <label class="required">
            <strong>{{ trans('fluxbb::common.username') }} <span>{{ trans('fluxbb::common.required') }}</span></strong><br />
            <input type="text" name="username" size="25" maxlength="25" /><br />
        </label>
    </fieldset>

    <fieldset>
        <legend>{{ trans('fluxbb::register.legend_pass') }}</legend>
        <label class="conl required">
            <strong>{{ trans('fluxbb::common.password') }} <span>{{ trans('fluxbb::common.required') }}</span></strong><br />
            <input type="password" name="password" size="16" /><br />
        </label>
        <label class="conl required">
            <strong>{{ trans('fluxbb::prof_reg.confirm_pass') }} <span>{{ trans('fluxbb::common.required') }}</span></strong><br />
            <input type="password" name="password_confirmation" size="16" /><br />
        </label>
        <p class="clearb">{{ trans('fluxbb::register.info_pass') }}</p>
    </fieldset>
    <fieldset>
        <legend>{{ trans('fluxbb::prof_reg.legend_email') }}</legend>

        <label class="required">
            <strong>{{ trans('fluxbb::common.email') }} <span>{{ trans('fluxbb::common.required') }}</span></strong><br />
            <input type="email" name="email" size="50" maxlength="80" /><br />{{-- TODO: Escape old input (see above, too) --}}
        </label>
    </fieldset>

    <p class="buttons"><input type="submit" name="register" value="{{ trans('fluxbb::register.register') }}" /></p>
</form>
@stop
