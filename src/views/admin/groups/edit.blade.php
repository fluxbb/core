@extends('fluxbb::admin.layout.main')

@section('main')

<h1>ADMIN groups</h1>

{{ $group->title }}

<h3>Permissions</h3>

<ul>
@foreach ($perms as $permission)
	<li>{{ $permission }}</li>
@endforeach
</ul>

@stop
