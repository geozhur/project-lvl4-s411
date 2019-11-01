@extends('layouts.app')

@section('content')
<div class="row my-4">
<div class="col-sm-12 my-4">
    <h3>Users</h3>
    <div class="table-responsive">
    <table class="table table-striped">
    <thead>
        <tr>
        <td>{{ __('ID') }}</td>
        <td>{{ __('Name') }}</td>
        <td>{{ __('Email') }}</td>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td><a href="{{ route('users.show', $user->id) }}">{{$user->name}}</a></td>
            <td>{{$user->email}}</td>
        </tr>
        @endforeach
    </tbody>
    </table>
  {{ $users->links() }}
</div>
</div>
</div>

@endsection
