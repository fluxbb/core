@layout('fluxbb::layout.main')

@section('main')
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
						<dt><strong>{{ e($post->poster->username) }}</strong></dt><!-- TODO: linkify if logged in and g_view_users is enabled for this group -->
						<dd class="usertitle"><strong>{{ e($post->poster->title()) }}</strong></dd>
	@if ($post->poster->has_avatar())
						<dd class="postavatar">{{ HTML::avatar($post->poster) }}</dd>
	@endif
	<?php if (count($user_info)) echo "\t\t\t\t\t\t".implode("\n\t\t\t\t\t\t", $user_info)."\n"; ?>
<?php if (count($user_contacts)) echo "\t\t\t\t\t\t".'<dd class="usercontacts">'.implode(' ', $user_contacts).'</dd>'."\n"; ?>

					</dl>
				</div>
				<div class="postright">
					<h3><?php if ($post->id != $topic->first_post_id) echo __('Re').' '; ?>{{ e($topic->subject) }}</h3>
					<div class="postmsg">
						{{ $post->message() }}
	@if ($post->was_edited())
						<p class="postedit"><em>{{ __('Last edit').' '.e($post->edited_by).' ('.HTML::format_time($post->edited) }})</em></p>
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
					<p><strong>{{ __('Online') }}</strong></p>
		@else
					<p><span>{{ __('Offline') }}</span></p>
		@endif
	@endif
				</div>
	@if (true)
				<div class="postfootright">
					<ul>
						<!-- TODO: Only show these if appropriate -->
						<li class="postreport"><span><a href="{{ URL::to_action('fluxbb::misc@report', array($post->id)) }}">{{ __('Report') }}</a></span></li>
						<li class="postdelete"><span><a href="{{ URL::to_action('fluxbb::post@delete', array($post->id)) }}">{{ __('Delete') }}</a></span></li>
						<li class="postedit"><span><a href="{{ URL::to_action('fluxbb::post@edit', array($post->id)) }}">{{ __('Edit') }}</a></span></li>
						<li class="postquote"><span><a href="{{ URL::to_action('fluxbb::post@quote', array($topic->id, $post->id)) }}">{{ __('Quote') }}</a></span></li>
					</ul>
				</div>
	@endif
			</div>
		</div>
	</div>
</div>
@endforeach

@endsection