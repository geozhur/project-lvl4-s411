@extends('layouts.app')

@section('content')
<div class="row my-4">
            @include('account.menu')
            <div class="col-12 col-md-9">
                <div class="card">
                    <div class="card-header">Email change</div>
                    <div class="card-body">
                            {{ Form::open(array('route' => 'account.updateEmail')) }}
                            {{ method_field('patch') }}
                            {{ Form::textAccount(['name' => 'email', 'value' => $user->email, 'label' => __('E-Mail Address')]) }}
                            {{ Form::textAccount(['name' => 'password_for_change_mail', 'type' => 'password',  'require' => true, 'label' => __('Password')]) }}
                            {{ Form::submit('Update Email',['class' => 'btn btn-primary offset-md-4']) }}
                            {{ Form::close() }}
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">Password change</div>
                    <div class="card-body">
                            {{ Form::open(array('route' => 'account.updatePassword')) }}
                            {{ method_field('patch') }}
                            {{ Form::textAccount(['name' => 'new_password', 'type' => 'password',  'require' => true, 'label' => __('New Password')]) }}
                            {{ Form::textAccount(['name' => 'confirm_new_password', 'type' => 'password',  'require' => true, 'label' => __('Confirm New Password')]) }}
                            {{ Form::textAccount(['name' => 'password_for_change_password', 'type' => 'password',  'require' => true, 'label' => __('Password')]) }}
                            {{ Form::submit('Update Password',['class' => 'btn btn-primary offset-md-4']) }}
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
