@extends('fluxbb::layout.main')

@section('main')

<a href="{{ route('new_topic', array('id' => $forum->id)) }}">{{ trans('fluxbb::forum.post_topic') }}</a>

<h2>{{ ($forum->forum_name) }}</h2>

<table cellspacing="0">
    <thead>
        <tr>
            <th scope="col">Topic</th>
            <th scope="col">{{ trans('fluxbb::common.replies') }}</th>
            <th scope="col">{{ trans('fluxbb::forum.views') }}</th> <!-- TODO: Only show if o_topic_views is enabled -->
            <th scope="col">{{ trans('fluxbb::common.last_post') }}</th>
        </tr>
    </thead>
    <tbody>

<?php $topic_count = 0; ?>
@foreach ($forum->topics as $topic)
<?php

$topic_count++;
$icon_type = 'icon';
if (FluxBB\Models\User::current()->isMember() && $topic->last_post > FluxBB\Models\User::current()->last_visit && (!isset($tracked_topics['topics'][$topic->id]) || $tracked_topics['topics'][$topic->id] < $topic->last_post) && (!isset($tracked_topics['forums'][$forum->id]) || $tracked_topics['forums'][$forum->id] < $topic->last_post) && is_null($topic->moved_to)) {
    // TODO: For obvious reasons, this if statement should not be here in the view (in that form)
    $icon_type = 'icon icon-new';
}

?>
        <tr>
            <td>
                <a href="{{ route('viewtopic', array('id' => $topic->id)) }}">{{ ($topic->subject) }}</a> {{ trans('fluxbb::common.by', array('author' => ($topic->poster))) }}
            </td>
            <td>{{ $topic->numReplies() }}</td>
            <td>{{ $topic->numViews() }}</td> <!-- TODO: Only show if o_topic_views is enabled -->
    @if ($topic->wasMoved())
            <td>- - -</td>
    @else
            <!-- TODO: Pass $last_post instead of $topic to url() -->
            <td><a href="{{ route('viewpost', array('id' => $topic->id)) }}#p{{ $topic->last_post_id }}">{{ ($topic->last_post) }}</a> <span class="byuser">{{ trans('fluxbb::common.by', array('author' => ($topic->last_poster))) }}</span></td>{{-- TODO: format_time for last_post --}}
    @endif
        </tr>
@endforeach

    </tbody>
</table>

<a href="{{ route('new_topic', array('id' => $forum->id)) }}">{{ trans('fluxbb::forum.post_topic') }}</a>

@stop
