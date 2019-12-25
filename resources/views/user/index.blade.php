@extends('layouts.app')
@section('content')
<div class="row my-4">
    <div class="col-sm-12 my-4">
        <h3>{{ __('user.users') }}</h3>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>{{ __('user.id') }}</td>
                        <td>{{ __('user.name') }}</td>
                        <td>{{ __('user.email') }}</td>
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
