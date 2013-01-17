@extends('fluxbb::admin.layout.main')

@section('main')

<h1>ADMIN groups</h1>

{{ $group->title }}

<h3>Permissions</h3>

<ul>
@foreach ($group->permissions as $permission)
	<li>{{ $permission->name }}</li>
@endforeach
</ul>

@stop
