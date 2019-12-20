@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12 my-4">
        <div class="card">
            <div class="card-header">{{ __('Edit task') }}</div>
            <div class="card-body">
                {{ Form::open(['route' => ['tasks.update', $task],'method' => 'patch']) }}

                <div class="form-group row">
                    {{ Form::label('name', __('Name').':',['class' => 'col-md-4 col-form-label text-md-right']) }}
                    <div class="col-md-6">
                    {{ Form::text('name', $task->name,['class' => 'form-control']) }}
                    </div>
                    @error('name')<span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>

                <div class="form-group row">
                {{ Form::label('executor', 'Executor:',['class' => 'col-md-4 col-form-label text-md-right']) }}
                    <div class="col-md-6">
                    {{ Form::select('assigned_to_id', $executors, $task->assignedto->id, ['class' => 'form-control']) }}
                    </div>
                    @error('assigned_to_id')<span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>

                <div class="form-group row">
                    {{ Form::label('description', 'Description:',['class' => 'col-md-4 col-form-label text-md-right']) }}
                    <div class="col-md-6">
                    {{ Form::textarea('description', $task->description, ['class' => 'form-control', 'id' => 'description']) }}
                    </div>
                    @error('description')<span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>

                <div class="form-group row">
                    {{ Form::label('status', 'Status:',['class' => 'col-md-4 col-form-label text-md-right']) }}
                    <div class="col-md-6">
                    {{ Form::select('status_id', $statuses, $task->status->id, ['class' => 'form-control']) }}
                    </div>
                    @error('status_id')<span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>

                <div class="form-group row">
                    {{ Form::label('tags', 'Tags:',['class' => 'col-md-4 col-form-label text-md-right']) }}
                    <div class="col-md-6">
                    {{ Form::select('tags[]', $tags, $task->tag->pluck('name', 'name'), ['class' => 'select2 form-control select2-multiple', 'multiple' => 'multiple']) }}
                    </div>
                    @error('tags')<span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>
                {{ Form::submit('Save',['class' => 'btn btn-primary offset-md-4']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
