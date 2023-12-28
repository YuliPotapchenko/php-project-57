@extends('layouts.app')

@section('h1')
    {{ __('task.title') }}
@endsection

@section('content')
    <main class="container py-4">
    <div class="d-flex mb-3">
        {{ Form::open(['url' => route('tasks.index'), 'method' => 'get']) }}
            <div class="row g-1">
            <div class="col">

                {{ Form::select('filter[status_id]', [ '' => __('task.status')] + $taskStatuses->pluck('name', 'id')
                    ->all(), $activeFilters['status_id'], ['class' =>"form-select me-2"]) }}
            </div>
            <div class="col">
                {{ Form::select('filter[created_by_id]', ['' => __('task.creator')] + $users->pluck('name', 'id')
                    ->all(), $activeFilters['created_by_id'], ['class' =>"form-select me-2"]) }}
            </div>
            <div class="col">
                {{ Form::select('filter[assigned_to_id]', ['' => __('task.assigned')] + $users->pluck('name', 'id')
                    ->all(), $activeFilters['assigned_to_id'], ['class' =>"form-select me-2"]) }}
            </div>
            <div class="col">
                {{ Form::submit(__('task.apply'), ['class' => "btn btn-outline-primary mr-2"]) }}
            </div>
        </div>
        {{ Form::close() }}
        @auth
            <div class="ms-auto">
                <a href="{{ route('tasks.create')}}" class="btn btn-primary ml-auto"> {{ __('task.create_task') }} </a>
            </div>
        @endauth
    </div>
    <table class="table me-2">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{ __('task.status') }}</th>
                <th>{{ __('task.name') }}</th>
                <th>{{ __('task.creator') }}</th>
                <th>{{ __('task.assigned') }}</th>
                <th>{{ __('task.created_at') }}</th>
                @auth
                <th>{{ __('task.actions') }}</th>
                @endauth
            </tr>
        </thead>
    <tbody>
        @foreach ($tasks as $task)
        <tr>
            <td>{{ $task->id }}</td>
            <td>{{ $task->status->name }}</td>
            <td><a href="{{ route('tasks.show', $task->id)}}">{{ $task->name }}</a></td>
            <td>{{ $task->createdBy->name }}</td>
            <td>{{ optional($task->assignedTo)->name }}</td>
            <td>{{ date('d.m.Y', strtotime($task->created_at)) }}</td>
            @auth
            <td>
                @can('delete', $task)

                    <a class="text-danger" data-method="DELETE" href="{{ route('tasks.destroy', $task) }}" data-confirm="{{ __('messages.alert.confirm') }}"  rel="nofollow">
                        {{ __('task.delete') }}
                    </a>
                @endcan
                    <a href="{{ route('tasks.edit', $task->id) }}" rel="nofollow">
                        {{ __('task.change') }}
                    </a>
            </td>
            @endauth
        </tr>
        @endforeach
    </tbody>
    </table>
    </main>
    <nav aria-label="navigation">
    {{ $tasks->links("pagination::bootstrap-4") }}
    </nav>
@endsection
