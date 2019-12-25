@extends('layouts.app')

@section('content')
    <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="img/tasklogo.svg" alt="" width="144" height="144">
        <h2>{{ __('welcome.project_task_management') }}</h2>
        <p class="text-left">
            <p>{{ __('welcome.text') }}</p>
        </p>
    </div>
@endsection
