@extends('layouts.app')

@section('content')
<div class="row my-4">
    @include('account.menu')
    <div class="col-12 col-md-9">
        <div class="card">
            <div class="card-header">{{ __('account.email_change') }}</div>
            <div class="card-body">
                {{ Form::open(array('route' => array('account.email.update', $user->id))) }}
                {{ method_field('patch') }}
                {{ Form::textAccount(['name' => 'email', 'value' => $user->email, 'label' => __('account.e-mail_address')]) }}
                {{ Form::textAccount(['name' => 'password_for_change_mail', 'type' => 'password',  'require' => true, 'label' => __('account.password')]) }}
                {{ Form::submit(__('account.update_email'),['class' => 'btn btn-primary offset-md-4']) }}
                {{ Form::close() }}
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">{{ __('account.password_change') }}</div>
            <div class="card-body">
                {{ Form::open(array('route' => array('account.password.update', $user->id))) }}
                {{ method_field('patch') }}
                {{ Form::textAccount(['name' => 'new_password', 'type' => 'password',  'require' => true, 'label' => __('account.new_password')]) }}
                {{ Form::textAccount(['name' => 'confirm_new_password', 'type' => 'password',  'require' => true, 'label' => __('account.confirm_new_password')]) }}
                {{ Form::textAccount(['name' => 'password_for_change_password', 'type' => 'password',  'require' => true, 'label' => __('account.password')]) }}
                {{ Form::submit(__('account.update_password'),['class' => 'btn btn-primary offset-md-4']) }}
                {{ Form::close() }}
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">{{ __('account.delele_account') }}</div>
            <div class="card-body">
                <a href="{{ route('account.destroy', $user->id) }} ?>"
                    class="btn btn-danger"
                        data-method="delete"
                        data-confirm="{{ __('account.are_you_sure') }}">
                        {{ __('account.delele_account') }}
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
