@extends('fluxbb::admin.layout.main')

@section('main')

Do you really want to delete the group "{{ $group->title }}"?

<form method="POST">
    <input type="submit" value="Yes!" />
    <a href="{{ route('admin_groups_index') }}">No, take me back!</a>
</form>

@stop
