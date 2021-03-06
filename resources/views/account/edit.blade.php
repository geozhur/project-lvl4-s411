@extends('layouts.app')

@section('content')
<div class="row my-4">
    @include('account.menu')
    <div class="col-12 col-md-9">
        <div class="card">
            <div class="card-header">{{ __('account.contact') }}</div>
            <div class="card-body">
                {{ Form::model($user, array('route' => array('account.update', $user->id))) }}
                {{ method_field('patch') }}
                {{ Form::textAccount(['name' => 'name', 'value' => $user->name, 'label' => __('account.name')]) }}
                {{ Form::submit(__('account.save'), ['class' => 'btn btn-primary offset-md-4']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@endsection
