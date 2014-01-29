@extends('fluxbb::layout.main')

@section('main')

<a href="{{ route('reply', array('id' => $topic->id)) }}">{{ trans('fluxbb::topic.post_reply') }}</a>

<?php $post_count = 0; ?>

<!-- TODO: Maybe use "render_each" here? (What about counting?) -->
@foreach ($topic->posts as $post)
<?php

$post_count++;
$post_classes = 'row';
if ($post->id == $topic->first_post_id) $post_classes .= ' firstpost';
if ($post_count == 1) $post_classes .= ' blockpost1';

?>
<div id="p{{ $post->id }}">
    <h2><a href="{{ route('viewpost', array('id' => $post->id)) }}#p{{ $post->id }}">{{ ($post->posted) }}</a></h2>{{-- TODO: format_time for posted --}}
    <dl>
    @if (fluxbb\Models\User::current()->canViewUsers())
        <dt><strong><a href="{{ route('profile', array('id' => $post->author->id)) }}">{{ ($post->author->username) }}</a></strong></dt>
    @else
        <dt><strong>{{ ($post->author->username) }}</strong></dt><!-- TODO: linkify if logged in and g_view_users is enabled for this group -->
    @endif
        <dd class="usertitle"><strong>{{ ($post->author->title()) }}</strong></dd>
    @if ($post->author->hasAvatar())
        <dd class="postavatar">{{ ($post->author->avatar) }}</dd>{{-- TODO: HTML::avatar() --}}
    @endif
    @if ($post->author->hasLocation()) <!-- TODO: and if user is allowed to view this (logged in and show_user_info -->
        <dd>{{ trans('fluxbb::topic.from', array('name' => ($post->author->location))) }}</dd>
    @endif
        <dd>{{ trans('fluxbb::topic.registered', array('time' => ($post->author->registered))) }}</dd>{{-- TODO: format_time for registered --}}
        <dd>{{ trans('fluxbb::topic.posts', array('count' => ($post->author->num_posts))) }}</dd>{{-- TODO: number_format --}}
        <dd><a href="get_host_for_pid" title="{{ $post->author->ip }}">{{ trans('fluxbb::topic.ip_address_logged') }}</a></dd>
    @if ($post->author->hasAdminNote())
        <dd>{{ trans('fluxbb::topic.note') }} <strong>{{ ($post->author->admin_note) }}</strong></dd>
    @endif

        <dd class="usercontacts">
            <span class="email"><a href="mailto:{{ $post->author->email }}">{{ trans('fluxbb::common.email') }}</a></span>
            <span class="email"><a href="{{ route('email', array('id' => $post->author->id)) }}">{{ trans('fluxbb::common.email') }}</a></span>
    @if ($post->author->hasUrl())
            <span class="website"><a href="{{ e($post->author->url) }}">{{ trans('fluxbb::topic.website') }}</a></span>
    @endif
        </dd>

    </dl>

    <h3><?php if ($post->id != $topic->first_post_id) echo trans('fluxbb::topic.re').' '; ?>{{ ($topic->subject) }}</h3>
    <div class="postmsg">
        {{ $post->message() }}
    @if ($post->wasEdited())
        <p class="postedit"><em>{{ trans('fluxbb::topic.last_edit').' '.($post->edited_by).' ('.($post->edited) }})</em></p>{{-- TODO: format_time for edited --}}
    @endif
    </div>
@if ($post->author->hasSignature())
    <div class="postsignature postmsg"><hr />{{ $post->author->signature() }}</div>
@endif

@if (!$post->author->guest())
    @if ($post->author->isOnline())
    <p><strong>{{ trans('fluxbb::topic.online') }}</strong></p>
    @else
    <p><span>{{ trans('fluxbb::topic.offline') }}</span></p>
    @endif
@endif

@if (true)
    <ul>
        <!-- TODO: Only show these if appropriate -->
        <li><a href="{{ route('post_report', array('id' => $post->id)) }}">{{ trans('fluxbb::topic.report') }}</a></li>
        <li><a href="{{ route('post_delete', array('id' => $post->id)) }}">{{ trans('fluxbb::topic.delete') }}</a></li>
        <li><a href="{{ route('post_edit', array('id' => $post->id)) }}">{{ trans('fluxbb::topic.edit') }}</a></li>
        <li><a href="{{ route('post_quote', array('id' => $post->id)) }}">{{ trans('fluxbb::topic.quote') }}</a></li>
    </ul>
@endif
</div>
@endforeach

<a href="{{ route('reply', array('id' => $topic->id)) }}">{{ trans('fluxbb::topic.post_reply') }}</a>

@stop
