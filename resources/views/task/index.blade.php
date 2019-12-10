@extends('layouts.app')
@section('content')
<div class="row my-4">
    <div class="col-sm-12 my-4">
        <h3>{{ __('Tasks') }}</h3>
        <hr/>
        <a class="btn btn-primary" href="{{ route('tasks.create') }}" style="margin-bottom: 15px;">{{ __('Create New') }}</a>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>{{ __('ID') }}</td>
                        <td>{{ __('Name') }}</td>
                        <td>{{ __('Action') }}</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td>{{$task->id}}</td>
                        <td><a href="{{ route('task.edit', $task->id) }}">{{$task->name}}</a></td>
                        <td>
                            <a class="btn btn-success btn-sm" href="{{ route('task', $task->id) }}">Edit</a>
                            <a href="{{ route('task.destroy', $task->id) }}"
                                class="btn btn-danger btn-sm"
                                    data-method="delete"
                                    data-confirm="{{ __('task.are_you_sure_task') }}">
                                    {{ __('task.delete') }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $tasks->links() }}
        </div>
    </div>
</div>
@endsection
