@extends('layouts.app')

@section('content')
<div class="row my-4">
    <div class="col-sm-12 my-4">
                    <h3>{{ __('task.task') }}: {{$task->name}}</h3>
                    <div class="table-responsive">
                        <table class="table table-striped">
                        <tbody>
                            <tr><td>{{ __('task.id') }}:</td><td>{{$task->id}}</td></tr>
                            <tr><td>{{ __('task.name') }}:</td><td>{{$task->name}}</td></tr>
                            <tr><td>{{ __('task.description') }}:</td><td>{{$task->description}}</td></tr>
                            <tr><td>{{ __('task.status') }}:</td><td>{{$task->status->name}}</td></tr>
                            <tr><td>{{ __('task.assigned_to') }}:</td><td>{{$task->assignedto->getName()}}</td></tr>
                            <tr><td>{{ __('task.tags') }}:</td><td>
                                @foreach ($task->tag as $singleTag)
                                <a href="#" class="badge badge-primary">{{ $singleTag->name }}</a>
                                @endforeach
                            </td></tr>
                            <tr><td>{{ __('task.update_time') }}:</td><td>{{$task->updated_at->format('d.m.Y H:i:s')}}</td></tr>
                        </tbody>
                        </table>
                    </div>
    </div>
</div>
@endsection
