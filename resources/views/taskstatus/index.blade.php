@extends('layouts.app')
@section('content')
<div class="row my-4">
    <div class="col-sm-12 my-4">
        <h3>{{ __('task.statuses') }}</h3>
        <hr/>
        <a class="btn btn-primary" href="{{ route('taskstatuses.create') }}" style="margin-bottom: 15px;">{{ __('task.create_new') }}</a>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>{{ __('task.id') }}</td>
                        <td>{{ __('task.name') }}</td>
                        <td>{{ __('task.action') }}</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($taskStatuses as $taskStatus)
                    <tr>
                        <td>{{$taskStatus->id}}</td>
                        <td><a href="{{ route('taskstatuses.edit', $taskStatus->id) }}">{{$taskStatus->name}}</a></td>
                        <td>
                            <a class="btn btn-success btn-sm" href="{{ route('taskstatuses.edit', $taskStatus->id) }}">{{ __('task.edit') }}</a>
                            <a href="{{ route('taskstatuses.destroy', $taskStatus->id) }}"
                                class="btn btn-danger btn-sm"
                                    data-method="delete"
                                    data-confirm="{{ __('task.are_you_sure_status') }}">
                                    {{ __('task.delete') }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $taskStatuses->links() }}
        </div>
    </div>
</div>
@endsection
