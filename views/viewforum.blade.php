@layout('fluxbb::layout.main')

@section('main')
<div id="vf" class="blocktable">
	<h2><span>{{ e($forum->forum_name) }}</span></h2>
	<div class="box">
		<div class="inbox">
			<table cellspacing="0">
			<thead>
				<tr>
					<th class="tcl" scope="col">{{ __('Topic') }}</th>
					<th class="tc2" scope="col">{{ __('Replies') }}</th>
					<th class="tc3" scope="col">{{ __('Views') }}</th> <!-- TODO: Only show if o_topic_views is enabled -->
					<th class="tcr" scope="col">{{ __('Last post') }}</th>
				</tr>
			</thead>
			<tbody>

<?php $topic_count = 0; ?>
@foreach ($topics as $topic)
<?php

$topic_count++;
$icon_type = 'icon';
if (fluxbb\User::current()->is_member() && $topic->last_post > fluxbb\User::current()->last_visit && (!isset($tracked_topics['topics'][$topic->id]) || $tracked_topics['topics'][$topic->id] < $topic->last_post) && (!isset($tracked_topics['forums'][$forum->id]) || $tracked_topics['forums'][$forum->id] < $topic->last_post) && is_null($topic->moved_to))
{
	// TODO: For obvious reasons, this if statement should not be here in the view (in that form)
	$icon_type = 'icon icon-new';
}

?>
				<tr class="row{{ HTML::oddeven() }}">
					<td class="tcl">
						<div class="{{ $icon_type }}"><div class="nosize">{{ number_format($topic_count + $start_from) }}</div></div><!-- TODO: forum_number_format() -->
						<div class="tclcon">
							<div>
								<a href="{{ URL::to_action('fluxbb::home@topic', array($topic->id)) }}">{{ e($topic->subject) }}</a> <span class="byuser">{{ __('by') }} {{ e($topic->poster) }}</span>
							</div>
						</div>
					</td>
					<td class="tc2">{{ $topic->num_replies() }}</td>
					<td class="tc3">{{ $topic->num_views() }}</td> <!-- TODO: Only show if o_topic_views is enabled -->
	@if ($topic->was_moved())
					<td class="tcr">- - -</td>
	@else
					<td class="tcr"><a href="{{ URL::to_action('fluxbb::home@post', array($topic->last_post_id)) }}#p{{ $topic->last_post_id }}">{{ HTML::format_time($topic->last_post) }}</a> <span class="byuser">{{ __('by') }} {{ e($topic->last_poster) }}</span></td>
	@endif
				</tr>
@endforeach

			</tbody>
			</table>
		</div>
	</div>
</div>

@endsection