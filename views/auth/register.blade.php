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
						<label class="required"><strong>{{ __('fluxbb::common.username') }} <span>{{ __('fluxbb::common.required') }}</span></strong><br /><input type="text" name="req_user" size="25" maxlength="25" /><br /></label>
					</div>
				</fieldset>
			</div>
{{-- TODO: if ($pun_config['o_regs_verify'] == '0') --}}
@if (true)
			<div class="inform">
				<fieldset>
					<legend>{{ __('fluxbb::register.legend_pass') }}</legend>
					<div class="infldset">
						<label class="conl required"><strong>{{ __('fluxbb::common.password') }} <span>{{ __('fluxbb::common.required') }}</span></strong><br /><input type="password" name="req_password1" size="16" /><br /></label>
						<label class="conl required"><strong>{{ __('fluxbb::prof_reg.confirm_pass') }} <span>{{ __('fluxbb::common.required') }}</span></strong><br /><input type="password" name="req_password2" size="16" /><br /></label>
						<p class="clearb">{{ __('fluxbb::common.info_pass') }}</p>
					</div>
				</fieldset>
			</div>
@endif
			<div class="inform">
				<fieldset>
	{{-- $pun_config['o_regs_verify'] == '1' --}}
	@if (true)
					<legend>{{ __('fluxbb::prof_reg.legend_email2') }}</legend>
	@else
					<legend>{{ __('fluxbb::prof_reg.legend_email') }}</legend>
	@endif
					<div class="infldset">
{{-- TODO: if ($pun_config['o_regs_verify'] == '1') --}}
@if (true)
					<p>{{ __('fluxbb::register.info_email') }}</p>
@endif
						<label class="required"><strong>{{ __('fluxbb::common.Email') }} <span>{{ __('fluxbb::common.required') }}</span></strong><br />
						<input type="text" name="req_email1" size="50" maxlength="80" /><br /></label>
{{-- TODO: if ($pun_config['o_regs_verify'] == '1') --}}
@if (true)
						<label class="required"><strong>{{ __('fluxbb::register.confirm_email') }} <span>{{ __('fluxbb::common.required') }}</span></strong><br />
						<input type="text" name="req_email2" size="50" maxlength="80" /><br /></label>
@endif
					</div>
				</fieldset>
			</div>
			<div class="inform">
				<fieldset>
					<legend>{{ __('fluxbb::prof_reg.legend_localization') }}</legend>
					<div class="infldset">
						<p>{{ __('fluxbb::prof_reg.info_timezone') }}</p>
						<label>{{ __('fluxbb::prof_reg.timezone') }}
						<br />
<?php
// TODO: This should be blade, but it doesn't support multi-line statements yet
echo Form::select('timezone', 
	array(
		-12		=> __('fluxbb::prof_reg.utc-12:00'),
		-11		=> __('fluxbb::prof_reg.utc-11:00'),
		-10		=> __('fluxbb::prof_reg.utc-10:00'),
		-9.5	=> __('fluxbb::prof_reg.utc-09:30'),
		-9		=> __('fluxbb::prof_reg.utc-09:00'),
		-8.5	=> __('fluxbb::prof_reg.utc-08:30'),
		-8		=> __('fluxbb::prof_reg.utc-08:00'),
		-7		=> __('fluxbb::prof_reg.utc-07:00'),
		-6		=> __('fluxbb::prof_reg.utc-06:00'),
		-5		=> __('fluxbb::prof_reg.utc-05:00'),
		-4		=> __('fluxbb::prof_reg.utc-04:00'),
		-3.5	=> __('fluxbb::prof_reg.utc-03:30'),
		-3		=> __('fluxbb::prof_reg.utc-03:00'),
		-2		=> __('fluxbb::prof_reg.utc-02:00'),
		-1		=> __('fluxbb::prof_reg.utc-01:00'),
		0		=> __('fluxbb::prof_reg.utc'),
		1		=> __('fluxbb::prof_reg.utc+01:00'),
		2		=> __('fluxbb::prof_reg.utc+02:00'),
		3		=> __('fluxbb::prof_reg.utc+03:00'),
		3.5		=> __('fluxbb::prof_reg.utc+03:30'),
		4		=> __('fluxbb::prof_reg.utc+04:00'),
		4.5		=> __('fluxbb::prof_reg.utc+04:30'),
		5		=> __('fluxbb::prof_reg.utc+05:00'),
		5.5		=> __('fluxbb::prof_reg.utc+05:30'),
		5.75	=> __('fluxbb::prof_reg.utc+05:45'),
		6		=> __('fluxbb::prof_reg.utc+06:00'),
		6.5		=> __('fluxbb::prof_reg.utc+06:30'),
		7		=> __('fluxbb::prof_reg.utc+07:00'),
		8		=> __('fluxbb::prof_reg.utc+08:00'),
		8.75	=> __('fluxbb::prof_reg.utc+08:45'),
		9		=> __('fluxbb::prof_reg.utc+09:00'),
		9.5		=> __('fluxbb::prof_reg.utc+09:30'),
		10		=> __('fluxbb::prof_reg.utc+10:00'),
		10.5	=> __('fluxbb::prof_reg.utc+10:30'),
		11		=> __('fluxbb::prof_reg.utc+11:00'),
		11.5	=> __('fluxbb::prof_reg.utc+11:30'),
		12		=> __('fluxbb::prof_reg.utc+12:00'),
		12.75	=> __('fluxbb::prof_reg.utc+12:45'),
		13		=> __('fluxbb::prof_reg.utc+13:00'),
		14		=> __('fluxbb::prof_reg.utc+14:00'),
	), $timezone, array('id' => 'time_zone')
);

?>
						<br /></label>
						<div class="rbox">
							<label>{{ Form::checkbox('dst', 1, $dst == 1).__('fluxbb::prof_reg.dst') }}<br /></label>
						</div>
@if (count($languages) > 1)
							<label>{{ __('fluxbb::prof_reg.language') }}
								<br />
								{{-- TODO: not 'en', but default language --}}
								{{ Form::select('language', $languages, 'en') }}
								<br />
							</label>
@endif
					</div>
				</fieldset>
			</div>
			<div class="inform">
				<fieldset>
					<legend>{{ __('fluxbb::prof_reg.legend_privacy') }}</legend>
					<div class="infldset">
						<p>{{ __('fluxbb::prof_reg.info_email_setting') }}</p>
						<div class="rbox">
							{{-- TODO: Funny, the value is always one lower than the language key --}}
							<label>{{ Form::radio('email_setting', 0, $email_setting == 0).__('fluxbb::prof_reg.email_setting1') }}<br /></label>
							<label>{{ Form::radio('email_setting', 1, $email_setting == 1).__('fluxbb::prof_reg.email_setting2') }}<br /></label>
							<label>{{ Form::radio('email_setting', 2, $email_setting == 2).__('fluxbb::prof_reg.email_setting3') }}<br /></label>
						</div>
					</div>
				</fieldset>
			</div>
			<p class="buttons"><input type="submit" name="register" value="{{ __('fluxbb::register.register') }}" /></p>
		</form>
	</div>
</div>
@endsection