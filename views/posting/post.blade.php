@layout('fluxbb::layout.main')

@section('main')
<div id="postform" class="blockform">
	<h2><span><?php echo $action ?></span></h2>
	<div class="box">
@if (isset($topic))
		{{ Form::open('core/topic/'.$topic->id.'/reply', 'PUT', array('id' => 'post', 'onsubmit' => 'this.submit.disabled=true;if(process_form(this)){return true;}else{this.submit.disabled=false;return false;')) }}
@else
		{{ Form::open('core/forum/'.$forum->id.'/new_topic', 'PUT', array('id' => 'post', 'onsubmit' => 'return process_form(this)')) }}
@endif
			<div class="inform">
				<fieldset>
					<legend>{{ __('fluxbb::common.write_message_legend') }}</legend>
					<div class="infldset txtarea">
						{{ Form::hidden('form_sent', '1') }}
<?php

$cur_index = 1;

if (!Auth::check())
{
	$email_label = fluxbb\Models\Config::enabled('p_force_guest_email') ? '<strong>'.__('fluxbb::common.email').' <span>'.__('fluxbb::common.required').'</span></strong>' : __('fluxbb::common.email');
	$email_form_name = fluxbb\Models\Config::enabled('p_force_guest_email') ? 'req_email' : 'email';

?>
						<label class="conl required"><strong>{{ __('fluxbb::post.guest_name') }} <span>{{ __('fluxbb::common.required') }}</span></strong><br />{{ Form::text('req_username', Input::old('req_username'), array('size' => '25', 'maxlength' => '25', 'tabindex' => $cur_index++)) }}<br /></label>
						<label class="conl<?php echo fluxbb\Models\Config::enabled('p_force_guest_email') ? ' required' : '' ?>"><?php echo $email_label ?><br />{{ Form::text($email_form_name, Input::old($email_form_name), array('size' => '50', 'maxlength' => '80', 'tabindex' => $cur_index++)) }}<br /></label>
						<div class="clearer"></div>
<?php

}

if (isset($forum)): ?>
						<label class="required"><strong>{{ __('fluxbb::common.subject') }} <span>{{ __('fluxbb::common.required') }}</span></strong><br />{{ Form::text('req_subject', Input::old('req_subject'), array('class' => 'longinput', 'size' => '80', 'tabindex' => $cur_index++)) }}<br /></label>
<?php endif; ?>						<label class="required"><strong>{{ __('fluxbb::common.message') }} <span>{{ __('fluxbb::common.required') }}</span></strong><br />
						{{ Form::textarea('req_message', Input::old('req_message'), array('rows' => '20', 'cols' => '95', 'tabindex' => $cur_index++)) }}<br /></label>
						<ul class="bblinks">
							<li><span><a href="help.php#bbcode" onclick="window.open(this.href); return false;">{{ __('fluxbb::common.bbcode') }}</a> <?php echo fluxbb\Models\Config::enabled('p_message_bbcode') ? __('fluxbb::common.on') : __('fluxbb::common.off'); ?></span></li>
							<li><span><a href="help.php#url" onclick="window.open(this.href); return false;">{{ __('fluxbb::common.url_tag') }}</a> <?php echo fluxbb\Models\Config::enabled('p_message_bbcode') && fluxbb\Models\User::current()->group->g_post_links == '1' ? __('fluxbb::common.on') : __('fluxbb::common.off'); ?></span></li>
							<li><span><a href="help.php#img" onclick="window.open(this.href); return false;">{{ __('fluxbb::common.img_tag') }}</a> <?php echo fluxbb\Models\Config::enabled('p_message_bbcode') && fluxbb\Models\Config::enabled('p_message_img_tag') ? __('fluxbb::common.on') : __('fluxbb::common.off'); ?></span></li>
							<li><span><a href="help.php#smilies" onclick="window.open(this.href); return false;">{{ __('fluxbb::common.smilies') }}</a> <?php echo fluxbb\Models\Config::enabled('o_smilies') ? __('fluxbb::common.on') : __('fluxbb::common.off'); ?></span></li>
						</ul>
					</div>
				</fieldset>
<?php

$checkboxes = array();
if (isset($topic) && $topic->forum->is_admmod() || isset($forum) && $forum->is_admmod())
	$checkboxes[] = '<label><input type="checkbox" name="stick_topic" value="1" tabindex="'.($cur_index++).'"'.(Input::has('stick_topic') ? ' checked="checked"' : '').' />'.__('fluxbb::common.stick_topic').'<br /></label>';

if (Auth::check())
{
	if (fluxbb\Models\Config::enabled('o_smilies'))
		$checkboxes[] = '<label><input type="checkbox" name="hide_smilies" value="1" tabindex="'.($cur_index++).'"'.(Input::has('hide_smilies') ? ' checked="checked"' : '').' />'.__('fluxbb::post.hide_smilies').'<br /></label>';

	if (fluxbb\Models\Config::enabled('o_topic_subscriptions'))
	{
		$is_subscribed = isset($topic) && $topic->is_user_subscribed();
		$subscr_checked = false;

		// If it's a preview
		if (Input::has('preview'))
			$subscr_checked = Input::has('subscribe');
		// If auto subscribed
		else if (fluxbb\Models\User::current()->auto_notify == '1')
			$subscr_checked = true;
		// If already subscribed to the topic
		else if ($is_subscribed)
			$subscr_checked = true;

		$checkboxes[] = '<label><input type="checkbox" name="subscribe" value="1" tabindex="'.($cur_index++).'"'.($subscr_checked ? ' checked="checked"' : '').' />'.($is_subscribed ? __('fluxbb::post.stay_subscribed') : __('fluxbb::post.subscribe')).'<br /></label>';
	}
}
else if (fluxbb\Models\Config::enabled('o_smilies'))
	$checkboxes[] = '<label><input type="checkbox" name="hide_smilies" value="1" tabindex="'.($cur_index++).'"'.(Input::has('hide_smilies') ? ' checked="checked"' : '').' />'.__('fluxbb::post.hide_smilies').'<br /></label>';

if (!empty($checkboxes))
{

?>
			</div>
			<div class="inform">
				<fieldset>
					<legend>{{ __('fluxbb::common.options') }}</legend>
					<div class="infldset">
						<div class="rbox">
							<?php echo implode("\n\t\t\t\t\t\t\t", $checkboxes)."\n" ?>
						</div>
					</div>
				</fieldset>
<?php

}

?>
			</div>
			<p class="buttons"><input type="submit" name="submit" value="{{ __('fluxbb::common.submit') }}" tabindex="<?php echo $cur_index++ ?>" accesskey="s" /> <input type="submit" name="preview" value="{{ __('fluxbb::post.preview') }}" tabindex="<?php echo $cur_index++ ?>" accesskey="p" /> <a href="javascript:history.go(-1)">{{ __('fluxbb::common.go_back') }}</a></p>
		{{ Form::close() }}
	</div>
</div>
@endsection
