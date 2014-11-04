@extends('fluxbb::...layout.main')

@section('main')
Pages: {{{ $users->links() }}}
<h2>User list</h2>

<table cellspacing="0">
    <thead>
        <tr>
            <th scope="col">Username</th>
            <th scope="col">Title</th>
            <th scope="col">Posts</th>
            <th scope="col">Registered</th>
        </tr>
    </thead>
    <tbody>

@foreach ($users as $user)
        <tr>
            <td><a href="{{ $route('profile', array('id' => $user->id)) }}">{{ $user->username }}</a></td>
            <td>{{ $user->title }}</td>
            <td>{{ $user->num_posts }}</td>
            <td>{{ $user->registered }}</td>
        </tr>
@endforeach

    </tbody>
</table>
@stop
