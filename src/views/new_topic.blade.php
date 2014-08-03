@extends('fluxbb::layout.main')

@section('main')
<h2>{{ trans('fluxbb::forum.post_topic') }}</h2>
<form action="{{ $route('new_topic', array('id' => $forum->id)) }}" method="POST" id="post">
    <fieldset>
        <legend>{{ trans('fluxbb::common.write_message_legend') }}</legend>
        <label class="required"><strong>{{ trans('fluxbb::common.subject') }} <span>{{ trans('fluxbb::common.required') }}</span></strong><br /><input type="text" name="subject" class="longinput" size="80" value="{{ Input::old('subject', '') }}" /><br /></label>
        <label class="required"><strong>{{ trans('fluxbb::common.message') }} <span>{{ trans('fluxbb::common.required') }}</span></strong><br /></label>
        <textarea name="message" id="message" cols="95" rows="20"></textarea><br /></label>
    </fieldset>

    <p class="buttons"><input type="submit" name="submit" value="{{ trans('fluxbb::common.submit') }}" /> <input type="submit" name="preview" value="{{ trans('fluxbb::post.preview') }}" /></p>
</form>
@stop
