@extends('fluxbb::layout.main')

@section('main')
<h2>{{ trans('fluxbb::register.register') }}</h2>
<form id="register" method="post" action="{{ route('register') }}" onsubmit="this.register.disabled=true;if(process_form(this)){return true;}else{this.register.disabled=false;return false;}">
    <h3>{{ trans('fluxbb::common.important') }}</h3>
    <p>{{ trans('fluxbb::register.desc1') }}</p>
    <p>{{ trans('fluxbb::register.desc2') }}</p>

    <fieldset>
        <legend>{{ trans('fluxbb::register.legend_username') }}</legend>
        <input type="hidden" name="form_sent" value="1" />
        {{-- TODO: Repopulate this with old values on errors --}}
        <label class="required">
            <strong>{{ trans('fluxbb::common.username') }} <span>{{ trans('fluxbb::common.required') }}</span></strong><br />
            <input type="text" name="user" size="25" maxlength="25" /><br />
        </label>
    </fieldset>

@if (FluxBB\Models\Config::disabled('o_regs_verify'))
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
@endif
    <fieldset>
@if (FluxBB\Models\Config::enabled('o_regs_verify'))
        <legend>{{ trans('fluxbb::prof_reg.legend_email2') }}</legend>
@else
        <legend>{{ trans('fluxbb::prof_reg.legend_email') }}</legend>
@endif

@if (FluxBB\Models\Config::enabled('o_regs_verify'))
        <p>{{ trans('fluxbb::register.info_email') }}</p>
@endif
        <label class="required">
            <strong>{{ trans('fluxbb::common.email') }} <span>{{ trans('fluxbb::common.required') }}</span></strong><br />
            <input type="email" name="email" size="50" maxlength="80" /><br />{{-- TODO: Escape old input (see above, too) --}}
        </label>
@if (FluxBB\Models\Config::enabled('o_regs_verify'))
        <label class="required">
            <strong>{{ trans('fluxbb::register.confirm_email') }} <span>{{ trans('fluxbb::common.required') }}</span></strong><br />
            <input type="email" name="email_confirmation" size="50" maxlength="80" /><br />
        </label>
@endif
    </fieldset>

@if (FluxBB\Models\Config::enabled('o_rules'))
    <fieldset>
        <legend>{{ trans('fluxbb::register.legend_pass') }}</legend>
        <label class="required">
            <strong>{{ trans('fluxbb::register.rules_legend') }} </strong><br /><br />{{ FluxBB\Models\Config::get('o_rules_message') }}
            <p class="checkbox"><input type="checkbox" name="rules" value="1" />{{ trans('fluxbb::register.agree') }}<span><strong>{{ trans('fluxbb::common.required') }}</strong></p></span>
        </label>
    </fieldset>
@endif
    <p class="buttons"><input type="submit" name="register" value="{{ trans('fluxbb::register.register') }}" /></p>
</form>
@stop
