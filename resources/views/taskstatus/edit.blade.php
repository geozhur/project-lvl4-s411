@extends('layouts.app')
@section('content')
<div class="row">
        <div class="col-sm-12 my-4">
    <div class="card">
        <div class="card-header">{{ __('Edit status') }}</div>
        <div class="card-body">
            {{ Form::model($taskstatus, ['route' => ['taskstatuses.update', $taskstatus->id], 'method' => 'patch']) }}
            {{ Form::textAccount(['name' => 'name', 'value' => $taskstatus->name, 'label' => __('Name')]) }}
            {{ Form::submit('Save',['class' => 'btn btn-primary offset-md-4']) }}
            {{ Form::close() }}
        </div>
    </div>
</div>
</div>
@endsection
