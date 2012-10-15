@extends('fluxbb::layout.main')

@section('main')
<div id="rules" class="block">
	<div class="hd"><h2><span>{{ trans('fluxbb::register.forum_rules') }}</span></h2></div>
	<div class="box">
		<div id="rules-block" class="inbox">
			<div class="usercontent">{{ $rules }}</div>
		</div>
	</div>
</div>
@stop