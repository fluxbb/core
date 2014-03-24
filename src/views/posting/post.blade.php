@extends('fluxbb::layout.main')

@section('main')
<h2><?php echo $action ?></h2>
@if (isset($topic))
<form action="{{ route('reply', array('id' => $topic->id)) }}" method="POST" id="post">
@elseif (isset($post))
<form action="{{ route('post_edit', array('id' => $post->id)) }}" method="POST" id="post">
@else
<form action="{{ route('new_topic', array('id' => $forum->id)) }}" method="POST" id="post">
@endif
    <fieldset>
        <legend>{{ trans('fluxbb::common.write_message_legend') }}</legend>
<?php

$cur_index = 1;

if (Auth::guest()) {
    $email_label = FluxBB\Models\Config::enabled('p_force_guest_email') ? '<strong>'.trans('fluxbb::common.email').' <span>'.trans('fluxbb::common.required').'</span></strong>' : trans('fluxbb::common.email');
    $email_form_name = FluxBB\Models\Config::enabled('p_force_guest_email') ? 'req_email' : 'email';

    ?>
        <label><strong>{{ trans('fluxbb::post.guest_name') }} <span>{{ trans('fluxbb::common.required') }}</span></strong><br /><input type="text" name="req_username" size="25" maxlength="25" value="" /><br /></label>
        <label class="conl<?php echo FluxBB\Models\Config::enabled('p_force_guest_email') ? ' required' : '' ?>"><?php echo $email_label ?><br /><input type="text" name="{{ $email_form_name }}" size="50" maxlength="80" value=""><br /></label>
    <?php

}

if (isset($forum) || (isset($post) && $post->isFirstPostOfTopic())) {
    $defaultSubject = isset($post) ? $post->topic->subject : '';

?>
        <label class="required"><strong>{{ trans('fluxbb::common.subject') }} <span>{{ trans('fluxbb::common.required') }}</span></strong><br /><input type="text" name="req_subject" class="longinput" size="80" value="{{ Input::old('req_subject', $defaultSubject) }}" /><br /></label>
<?php
}
?>
        <label class="required"><strong>{{ trans('fluxbb::common.message') }} <span>{{ trans('fluxbb::common.required') }}</span></strong><br /></label>
        <textarea name="req_message" id="req_message" cols="95" rows="20">{{ isset($post) ? $post->message : '' }}</textarea><br /></label>
        <ul class="bblinks">
            <li><span><a href="help.php#bbcode" onclick="window.open(this.href); return false;">{{ trans('fluxbb::common.bbcode') }}</a> <?php echo FluxBB\Models\Config::enabled('p_message_bbcode') ? trans('fluxbb::common.on') : trans('fluxbb::common.off'); ?></span></li>
            <li><span><a href="help.php#url" onclick="window.open(this.href); return false;">{{ trans('fluxbb::common.url_tag') }}</a> <?php echo FluxBB\Models\Config::enabled('p_message_bbcode') && FluxBB\Models\User::current()->group->g_post_links == '1' ? trans('fluxbb::common.on') : trans('fluxbb::common.off'); ?></span></li>
            <li><span><a href="help.php#img" onclick="window.open(this.href); return false;">{{ trans('fluxbb::common.img_tag') }}</a> <?php echo FluxBB\Models\Config::enabled('p_message_bbcode') && FluxBB\Models\Config::enabled('p_message_img_tag') ? trans('fluxbb::common.on') : trans('fluxbb::common.off'); ?></span></li>
            <li><span><a href="help.php#smilies" onclick="window.open(this.href); return false;">{{ trans('fluxbb::common.smilies') }}</a> <?php echo FluxBB\Models\Config::enabled('o_smilies') ? trans('fluxbb::common.on') : trans('fluxbb::common.off'); ?></span></li>
        </ul>
    </fieldset>
<?php

$checkboxes = array();
if (isset($topic) && $topic->forum->isAdmMod() || isset($forum) && $forum->isAdmMod()) {
    $checkboxes[] = '<label><input type="checkbox" name="stick_topic" value="1" tabindex="'.($cur_index++).'" />'.trans('fluxbb::common.stick_topic').'<br /></label>';
}

if (Auth::check()) {
    if (FluxBB\Models\Config::enabled('o_smilies')) {
        $checkboxes[] = '<label><input type="checkbox" name="hide_smilies" value="1" tabindex="'.($cur_index++).'" />'.trans('fluxbb::post.hide_smilies').'<br /></label>';
    }

    if (FluxBB\Models\Config::enabled('o_topic_subscriptions')) {
        $is_subscribed = isset($topic) && $topic->isUserSubscribed();
        $subscr_checked = false;

        // If it's a preview
        //if (Input::has('preview'))
            //$subscr_checked = Input::has('subscribe');
        // If auto subscribed
        /* else */
        if (FluxBB\Models\User::current()->auto_notify == '1') {
            $subscr_checked = true;
        } elseif ($is_subscribed) { // If already subscribed to the topic
            $subscr_checked = true;
        }

        $checkboxes[] = '<label><input type="checkbox" name="subscribe" value="1" tabindex="'.($cur_index++).'"'.($subscr_checked ? ' checked="checked"' : '').' />'.($is_subscribed ? trans('fluxbb::post.stay_subscribed') : trans('fluxbb::post.subscribe')).'<br /></label>';
    }
} elseif (FluxBB\Models\Config::enabled('o_smilies')) {
    $checkboxes[] = '<label><input type="checkbox" name="hide_smilies" value="1" tabindex="'.($cur_index++).'" />'.trans('fluxbb::post.hide_smilies').'<br /></label>';
}

?>

@if (!empty($checkboxes))
    <fieldset>
        <legend>{{ trans('fluxbb::common.options') }}</legend>
        <?php echo implode("\n\t\t\t\t\t\t\t", $checkboxes)."\n" ?>
    </fieldset>
@endif
    <p class="buttons"><input type="submit" name="submit" value="{{ trans('fluxbb::common.submit') }}" tabindex="<?php echo $cur_index++ ?>" accesskey="s" /> <input type="submit" name="preview" value="{{ trans('fluxbb::post.preview') }}" tabindex="<?php echo $cur_index++ ?>" accesskey="p" /> <a href="javascript:history.go(-1)">{{ trans('fluxbb::common.go_back') }}</a></p>
</form>
@stop
