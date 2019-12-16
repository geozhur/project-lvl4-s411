@extends('layouts.app')

@section('content')
<div class="row my-4">
    <div class="col-sm-12 my-4">
                    <h3>{{ __(' Task') }}: {{$task->name}}</h3>
                    <div class="table-responsive">
                        <table class="table table-striped">
                        <tbody>
                            <tr><td>{{ __('Id') }}:</td><td>{{$task->id}}</td></tr>
                            <tr><td>{{ __('Name') }}:</td><td>{{$task->name}}</td></tr>
                            <tr><td>{{ __('Description') }}:</td><td>{{$task->description}}</td></tr>
                            <tr><td>{{ __('Update Date') }}:</td><td>{{$task->updated_at->format('d.m.Y')}}</td></tr>
                        </tbody>
                        </table>
                    </div>
    </div>
</div>
@endsection
