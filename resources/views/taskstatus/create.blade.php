@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12 my-4">
        <div class="card">
            <div class="card-header">{{ __('task.create_status') }}</div>
            <div class="card-body">
                {{ Form::open(['route' => ['taskstatuses.store']]) }}
                {{ Form::textAccount(['name' => 'name', 'label' => __('task.name')]) }}
                {{ Form::submit(__('task.save'),['class' => 'btn btn-primary offset-md-4']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
