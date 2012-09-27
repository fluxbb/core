@extends('fluxbb::layout.main')

@section('main')
{{-- TODO: Escape all the variables!!! --}}
<ul>
@foreach ($categories as $cat_info)
<?php $category = $cat_info['category']; ?>
	<li>
		{{ $category->cat_name }}
		<ul>
@foreach ($cat_info['forums'] as $forum)
			<li>
				<a href="{{ URL::action('fluxbb::home@forum', array($forum->id)) }}">{{ $forum->forum_name }}</a>
				<span class="forumdesc">{{ $forum->forum_desc }}</span>
				<ul>
					<li>{{ $forum->numTopics() }} topics</li>
					<li>{{ $forum->numPosts() }} posts</li>
				</ul>
			</li>
@endforeach
		</ul>
	</li>
@endforeach
</ul>

@endsection
