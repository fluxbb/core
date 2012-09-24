@layout('fluxbb::layout.main')

@section('main')

<div class="linkst">
	<div class="inbox crumbsplus">
		<div class="pagepost">
			<p class="postlink conr"><a href="{{ URL::to_action('fluxbb::posting@reply', array($topic->id)) }}">{{ __('fluxbb::topic.post_reply') }}</a></p>
		</div>
		<div class="clearer"></div>
	</div>
</div>

<?php $post_count = 0; ?>

<!-- TODO: Maybe use "render_each" here? (What about counting?) -->
@foreach ($posts as $post)
<?php

$post_count++;
$post_classes = 'row'.HTML::oddeven();
if ($post->id == $topic->first_post_id) $post_classes .= ' firstpost';
if ($post_count == 1) $post_classes .= ' blockpost1';

?>
<div id="p{{ $post->id }}" class="blockpost {{ $post_classes }}">
	<h2><span><span class="conr">#{{ $start_from + $post_count }}</span> <a href="{{ URL::to_action('fluxbb::home@post', array($post->id)) }}#p{{ $post->id }}">{{ HTML::format_time($post->posted) }}</a></span></h2>
	<div class="box">
		<div class="inbox">
			<div class="postbody">
				<div class="postleft">
					<dl>
	@if (fluxbb\Models\User::current()->can_view_users())
						<dt><strong>{{ HTML::link_to_action('fluxbb::user@profile', $post->poster->username, array($post->poster_id)) }}</strong></dt>
	@else
						<dt><strong>{{ e($post->poster->username) }}</strong></dt><!-- TODO: linkify if logged in and g_view_users is enabled for this group -->
	@endif
						<dd class="usertitle"><strong>{{ e($post->poster->title()) }}</strong></dd>
	@if ($post->poster->has_avatar())
						<dd class="postavatar">{{ HTML::avatar($post->poster) }}</dd>
	@endif
	@if ($post->poster->has_location()) <!-- TODO: and if user is allowed to view this (logged in and show_user_info -->
						<dd><span>{{ __('fluxbb::topic.from', array('name' => e($post->poster->location))) }}</span></dd>
	@endif
						<dd><span>{{ __('fluxbb::topic.registered', array('time' => HTML::format_time($post->poster->registered, true))) }}</span></dd>
						<dd><span>{{ __('fluxbb::topic.posts', array('count' => HTML::number_format($post->poster->num_posts))) }}</span></dd>
						<dd><span><a href="{{ URL::to_action('fluxbb::moderate@host', array($post->id)) }}" title="{{ $post->poster->ip }}">{{ __('fluxbb::topic.ip_address_logged') }}</a></span></dd>
	@if ($post->poster->has_admin_note())
						<dd><span>{{ __('fluxbb::topic.note') }} <strong>{{ e($post->poster->admin_note) }}</strong></span></dd>
	@endif

						<dd class="usercontacts">
							<span class="email"><a href="mailto:{{ $post->poster_email }}">{{ __('fluxbb::common.email') }}</a></span>
							<span class="email"><a href="{{ URL::to_action('fluxbb::misc@email', array($post->poster_id)) }}">{{ __('fluxbb::common.email') }}</a></span>
	@if ($post->poster->has_url())
							<span class="website"><a href="{{ e($post->poster->url) }}">{{ __('fluxbb::topic.website') }}</a></span>
	@endif
						</dd>

					</dl>
				</div>
				<div class="postright">
					<h3><?php if ($post->id != $topic->first_post_id) echo __('fluxbb::topic.re').' '; ?>{{ e($topic->subject) }}</h3>
					<div class="postmsg">
						{{ $post->message() }}
	@if ($post->was_edited())
						<p class="postedit"><em>{{ __('fluxbb::topic.last_edit').' '.e($post->edited_by).' ('.HTML::format_time($post->edited) }})</em></p>
	@endif
					</div>
	@if ($post->poster->has_signature())
					<div class="postsignature postmsg"><hr />{{ $post->poster->signature() }}</div>
	@endif
				</div>
			</div>
		</div>
		<div class="inbox">
			<div class="postfoot clearb">
				<div class="postfootleft">
	@if (!$post->poster->is_guest())
		@if ($post->poster->is_online())
					<p><strong>{{ __('fluxbb::topic.online') }}</strong></p>
		@else
					<p><span>{{ __('fluxbb::topic.offline') }}</span></p>
		@endif
	@endif
				</div>
	@if (true)
				<div class="postfootright">
					<ul>
						<!-- TODO: Only show these if appropriate -->
						<li class="postreport"><span><a href="{{ URL::to_action('fluxbb::misc@report', array($post->id)) }}">{{ __('fluxbb::topic.report') }}</a></span></li>
						<li class="postdelete"><span><a href="{{ URL::to_action('fluxbb::post@delete', array($post->id)) }}">{{ __('fluxbb::topic.delete') }}</a></span></li>
						<li class="postedit"><span><a href="{{ URL::to_action('fluxbb::post@edit', array($post->id)) }}">{{ __('fluxbb::topic.edit') }}</a></span></li>
						<li class="postquote"><span><a href="{{ URL::to_action('fluxbb::post@quote', array($topic->id, $post->id)) }}">{{ __('fluxbb::topic.quote') }}</a></span></li>
					</ul>
				</div>
	@endif
			</div>
		</div>
	</div>
</div>
@endforeach

<div class="postlinksb">
	<div class="inbox crumbsplus">
		<div class="pagepost">
			<p class="postlink conr"><a href="{{ URL::to_action('fluxbb::posting@reply', array($topic->id)) }}">{{ __('fluxbb::topic.post_reply') }}</a></p>
		</div>
		<div class="clearer"></div>
	</div>
</div>

@endsection
