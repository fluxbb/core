@layout('fluxbb::layout.main')

@section('main')
<div id="regform" class="blockform">
	<h2><span>{{ __('fluxbb::register.register') }}</span></h2>
	<div class="box">
		<form id="register" method="post" action="{{ URL::to_action('fluxbb::auth@register') }}" onsubmit="this.register.disabled=true;if(process_form(this)){return true;}else{this.register.disabled=false;return false;}">
			<div class="inform">
				<div class="forminfo">
					<h3>{{ __('fluxbb::common.important') }}</h3>
					<p>{{ __('fluxbb::register.desc1') }}</p>
					<p>{{ __('fluxbb::register.desc2') }}</p>
				</div>
				<fieldset>
					<legend>{{ __('fluxbb::register.legend_username') }}</legend>
					<div class="infldset">
						<input type="hidden" name="form_sent" value="1" />
						{{-- TODO: Repopulate this with old values on errors --}}
						<label class="required">
							<strong>{{ __('fluxbb::common.username') }} <span>{{ __('fluxbb::common.required') }}</span></strong><br />
							{{ Form::text('req_user', Input::old('req_user'), array('size' => 25, 'maxlength' => 25)) }}<br />
						</label>
					</div>
				</fieldset>
			</div>
@if (fluxbb\Models\Config::disabled('o_regs_verify'))
			<div class="inform">
				<fieldset>
					<legend>{{ __('fluxbb::register.legend_pass') }}</legend>
					<div class="infldset">
						<label class="conl required">
							<strong>{{ __('fluxbb::common.password') }} <span>{{ __('fluxbb::common.required') }}</span></strong><br />
							{{ Form::password('req_password', array('size' => 16)) }}<br />
						</label>
						<label class="conl required">
							<strong>{{ __('fluxbb::prof_reg.confirm_pass') }} <span>{{ __('fluxbb::common.required') }}</span></strong><br />
							{{ Form::password('req_password_confirmation', array('size' => 16)) }}<br />
						</label>
						<p class="clearb">{{ __('fluxbb::register.info_pass') }}</p>
					</div>
				</fieldset>
			</div>
@endif
			<div class="inform">
				<fieldset>
@if (fluxbb\Models\Config::enabled('o_regs_verify'))
					<legend>{{ __('fluxbb::prof_reg.legend_email2') }}</legend>
@else
					<legend>{{ __('fluxbb::prof_reg.legend_email') }}</legend>
@endif
					<div class="infldset">
@if (fluxbb\Models\Config::enabled('o_regs_verify'))
					<p>{{ __('fluxbb::register.info_email') }}</p>
@endif
						<label class="required">
							<strong>{{ __('fluxbb::common.email') }} <span>{{ __('fluxbb::common.required') }}</span></strong><br />
							{{ Form::text('req_email', Input::old('req_email'), array('size' => 50, 'maxlength' => 80)) }}<br />
						</label>
@if (fluxbb\Models\Config::enabled('o_regs_verify'))
						<label class="required">
							<strong>{{ __('fluxbb::register.confirm_email') }} <span>{{ __('fluxbb::common.required') }}</span></strong><br />
							{{ Form::text('req_email_confirmation', Input::old('req_email_confirmation'), array('size' => 50, 'maxlength' => 80)) }}<br />
						</label>
@endif
					</div>
				</fieldset>
			</div>
			<p class="buttons"><input type="submit" name="register" value="{{ __('fluxbb::register.register') }}" /></p>
		</form>
	</div>
</div>
@endsection
