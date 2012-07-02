@layout('fluxbb::layout.main')

@section('main')
@foreach ($categories as $category)
<div id="idx{{ $category->id }}" class="blocktable"> <!-- supposed to be $cat_count -->
	<h2><span>{{ e($category->cat_name) }}</span></h2>
	<div class="box">
		<div class="inbox">
			<table cellspacing="0">
			<thead>
				<tr>
					<th class="tcl" scope="col">{{ __('Forum') }}</th>
					<th class="tc2" scope="col">{{ __('Topics') }}</th>
					<th class="tc3" scope="col">{{ __('Posts') }}</th>
					<th class="tcr" scope="col">{{ __('Last post') }}</th>
				</tr>
			</thead>
			<tbody>
	@foreach ($category->forums as $forum)
				<tr class="row{{ HTML::oddeven() }}">
					<td class="tcl">
						<div class="{{ '$icon_type' }}"><div class="nosize">{{ number_format(intval('$forum_count')) }}</div></div><!-- forum_number_format -->
						<div class="tclcon">
							<div>
<?php
	if ($forum->redirect_url != '')
	{
		$forum_field = '<h3><span class="redirtext">'.__('Link to').'</span> <a href="'.e($forum->redirect_url).'" title="'.__('Link to').' '.e($forum->redirect_url).'">'.e($forum->forum_name).'</a></h3>';
	}
	else
	{
		$forum_field = '<h3><a href="'.URL::to_action('fluxbb::home@forum', array($forum->id)).'">'.e($forum->forum_name).'</a>'.(!empty($forum_field_new) ? ' '.$forum_field_new : '').'</h3>';
	}

	if ($forum->forum_desc != '')
		$forum_field .= "\n\t\t\t\t\t\t\t\t".'<div class="forumdesc">'.$forum->forum_desc.'</div>';
?>
								{{ $forum_field }}
							</div>
						</div>
					</td>
					<td class="tc2">{{ number_format($forum->num_topics()) }}</td><!-- forum_number_format -->
					<td class="tc3">{{ number_format($forum->num_posts()) }}</td><!-- here too -->
					<td class="tcr">{{ '$last_post' }}</td>
				</tr>
	@endforeach
			</tbody>
			</table>
		</div>
	</div>
</div>
@endforeach
@endsection