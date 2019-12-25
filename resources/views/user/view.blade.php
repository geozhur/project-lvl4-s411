@extends('layouts.app')

@section('content')
<div class="row my-4">
    <div class="col-sm-12 my-4">
                    <h3>{{$user->name}}</h3>
                    <div class="table-responsive">
                        <table class="table table-striped">
                        <tbody>
                            <tr><td>{{ __('user.id') }}:</td><td>{{$user->id}}</td></tr>
                            <tr><td>{{ __('user.email') }}:</td><td>{{$user->email}}</td></tr>
                            <tr><td>{{ __('user.create_date') }}:</td><td>{{$user->created_at->format('d.m.Y')}}</td></tr>
                        </tbody>
                        </table>
                    </div>
    </div>
</div>
@endsection
