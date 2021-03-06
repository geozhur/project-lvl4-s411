@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12 my-4">
        <div class="card">
            <div class="card-header">{{ __('task.create_new') }}</div>
            <div class="card-body">
                {{ Form::open(['route' => ['tasks.store']]) }}

                <div class="form-group row">
                    {{ Form::label('name', __('task.name').':',['class' => 'col-md-4 col-form-label text-md-right']) }}
                    <div class="col-md-6">
                    {{ Form::text('name', null,['class' => 'form-control']) }}
                    @error('name')<span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                </div>

                <div class="form-group row">
                {{ Form::label('assigned_to', __('task.assigned_to') .':',['class' => 'col-md-4 col-form-label text-md-right']) }}
                    <div class="col-md-6">
                    {{ Form::select('assigned_to_id', $executors, null, ['class' => 'form-control']) }}
                    @error('assigned_to_id')<span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                </div>

                <div class="form-group row">
                    {{ Form::label('description',  __('task.description').':',['class' => 'col-md-4 col-form-label text-md-right']) }}
                    <div class="col-md-6">
                    {{ Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description']) }}
                    @error('description')<span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                </div>

                <div class="form-group row">
                    {{ Form::label('status', __('task.status').':',['class' => 'col-md-4 col-form-label text-md-right']) }}
                    <div class="col-md-6">
                    {{ Form::select('status_id', $statuses, null, ['class' => 'form-control']) }}
                    @error('status_id')<span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                </div>

                <div class="form-group row">
                    {{ Form::label('tags', 'Tags:',['class' => 'col-md-4 col-form-label text-md-right']) }}
                    <div class="col-md-6">
                    {{ Form::select('tags[]', $tags, old('tags'), ['class' => 'select2 form-control select2-multiple', 'multiple' => 'multiple']) }}
                    @if ($errors->has('tags.*'))<span class="invalid-feedback d-block" role="alert"><strong>{{ $errors->first('tags.*') }}</strong></span>@endif
                    </div>
                </div>
                {{ Form::submit(__('task.save'),['class' => 'btn btn-primary offset-md-4']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
