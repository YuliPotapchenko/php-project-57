@extends('layouts.app')

@section('h1')
    {{ __('taskStatus.title') }}
@endsection

@section('content')
    @if (Auth::user())
    <a href="{{  route('task_statuses.create') }}" class="btn btn-primary">
        {{ __('taskStatus.create_status') }}
    </a>
    @endif
    <table class="table mt-2">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{ __('taskStatus.name') }}</th>
                <th>{{__('taskStatus.created_at')}}</th>
                @auth
                <th>{{ __('taskStatus.actions') }}</th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach ($taskStatuses as $taskStatus)
            <tr>
                <td>{{ $taskStatus->id }}</td>
                <td>{{ $taskStatus->name }}</td>
                <td>{{ date('d.m.Y', strtotime($taskStatus->created_at)) }}</td>
                <td>
                    @auth
                        <a class="text-danger" href="{{ route('task_statuses.destroy', $taskStatus)}}"
                           data-confirm="{{ __('messages.alert.confirm') }}"
                           data-method="delete"
                           rel="nofollow"
                        >{{ __('taskStatus.delete') }}
                        </a>
                        <a href="{{ route('task_statuses.edit', $taskStatus) }}">
                            {{ __('taskStatus.change') }}
                        </a>
                    @endauth
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <nav aria-label="navigation">
        {{ $taskStatuses->links("pagination::bootstrap-4") }}
    </nav>
@endsection
