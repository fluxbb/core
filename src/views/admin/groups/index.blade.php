@extends('fluxbb::admin.layout.main')

@section('main')

<h1>ADMIN groups</h1>

@foreach ($groups as $group)
	<p><a href="{{ route('admin_groups_edit', array($group->id)) }}">{{ $group->title }}</a></p>
@endforeach

@stop
