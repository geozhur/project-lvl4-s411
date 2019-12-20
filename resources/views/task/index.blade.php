@extends('layouts.app')
@section('content')
<div class="row my-4">
    <div class="col-sm-12 my-4">
        <h3>{{ __('Tasks') }}</h3>
        <form class="mb-2" action="{{ route('tasks.index') }}" method="GET">
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="status">Status</label>
                    <select id="status" class="custom-select" name="status">
                        <option value="" {{ Request::get('status') ? '' : 'selected' }}>All</option>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}" {{ Request::get('status') === $status->id ? 'selected' : '' }}>
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-5">
                    <label for="assigned_to_id">Assigned user</label>
                    <select id="assigned_to_id" class="custom-select" name="assigned_to_id">
                        <option value="" {{ Request::get('assigned_to_id') ? '' : 'selected' }}>All</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ Request::get('assigned_to_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="tag">Tag</label>
                    <select id="tag" class="custom-select" name="tag">
                        <option value="" {{ Request::get('tag') ? '' : 'selected' }}>All</option>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->name }}" {{ Request::get('tag') === $tag->name ? 'selected' : '' }}>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-9">
                    <div class="form-check">
                        <input id=is_my_task" class="form-check-input" type="checkbox" name="is_my_task" {{ Request::get('is_my_task') ? 'checked' : '' }}>
                        <label for="is_my_task" class="form-check-label">Created by me</label>
                    </div>
                </div>
                <div class="form-group col-md-3 d-flex justify-content-around">
                    <button type="submit" class="btn btn-outline-success">Search</button>
                    <a class="btn btn-outline-success" href="{{ route('tasks.index') }}">Show all</a>
                </div>
            </div>
        </form>

        <hr/>
        <a class="btn btn-primary" href="{{ route('tasks.create') }}" style="margin-bottom: 15px;">{{ __('Create New') }}</a>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>{{ __('ID') }}</td>
                        <td>{{ __('Name') }}</td>
                        <td>{{ __('Status') }}</td>
                        <td>{{ __('Assigned to') }}</td>
                        <td>{{ __('Tags') }}</td>
                        <td>{{ __('Action') }}</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td>{{$task->id}}</td>
                        <td><a href="{{ route('tasks.show', $task->id) }}">{{$task->name}}</a></td>
                        <td>{{$task->status->name}}</td>
                        <td>{{$task->assignedto->getName()}}</td>
                        <td>
                            @foreach ($task->tag as $singleTag)
                            <a href="{{ route('tasks.index', ['tag' => $singleTag->name] ) }}" class="badge badge-primary">{{ $singleTag->name }}</a>
                            @endforeach
                        </td>
                        <td>
                            <a class="btn btn-success btn-sm" href="{{ route('tasks.edit', $task->id) }}">Edit</a>
                            <a href="{{ route('tasks.destroy', $task->id) }}"
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
