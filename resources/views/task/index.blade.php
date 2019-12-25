@extends('layouts.app')
@section('content')
<div class="row my-4">
    <div class="col-sm-12 my-4">
        <h3>{{ __('task.tasks') }}</h3>
        <hr/>
        <a class="btn btn-primary" href="{{ route('tasks.create') }}" style="margin-bottom: 15px;"><i class="mr-2 fa fa-plus"></i>{{ __('task.create_new') }}</a>
        <div class="table-responsive">
            {{ Form::open(['route' => ['tasks.index'],'method' => 'get']) }}
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <td>{{ __('task.id') }}</td>
                        <td>{{ __('task.name') }}</td>
                        <td>{{ __('task.status') }}</td>
                        <td>{{ __('task.assigned_to') }}</td>
                        <td>{{ __('task.tags') }}</td>
                        <td style="width:75px">{{ __('task.action') }}</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2">{{ Form::label('my', 'My tasks:',['class' => 'pl-4 col-form-label col-form-label-sm']) }}{{ Form::checkbox('mytasks', '1', Request::get('mytasks'), ['class' => 'ml-1','onchange' => "this.form.submit();"]) }}</td>
                        <td>{{ Form::select('status', $statuses, Request::get('status'), ['placeholder' => '', 'class' => 'form-control form-control-sm', 'onchange' => "this.form.submit();"]) }}</td>
                        <td>{{ Form::select('assignedto', $users, Request::get('assignedto'), ['placeholder' => '', 'class' => 'form-control form-control-sm', 'onchange' => "this.form.submit();"]) }}</td>
                        <td>{{ Form::select('tag', $tags, Request::get('tag'), ['placeholder' => '', 'class' => 'form-control form-control-sm', 'onchange' => "this.form.submit();"]) }}</td>
                        <td>
                            {{ Form::button('<i class="fa fa-search"></i>', ['class' => 'btn btn-outline-secondary btn-sm', 'type' => 'submit']) }}
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('tasks.index') }}"><i class="fa fa-refresh"></i></a>
                        </td>
                    </tr>
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
                            <a class="btn btn-primary btn-success btn-sm" href="{{ route('tasks.edit', $task->id) }}"><i class="fa fa-cog"></i></a>
                            <a href="{{ route('tasks.destroy', $task->id) }}"
                                class="btn btn-danger btn-sm"
                                    data-method="delete"
                                    data-confirm="{{ __('task.are_you_sure_task') }}">
                                    <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $tasks->links() }}
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
