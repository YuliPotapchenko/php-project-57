@php
    use App\Helpers\TaskStatusHelper;
    use App\Helpers\UserHelper;
@endphp
@extends('layouts.app')
@section('content')

    <div class="grid col-span-full">
        <h1 class="max-w-2xl mb-4 text-4xl leading-none tracking-tight md:text-5xl xl:text-6xl dark:text-white">
            {{ __('layout.task_header') }} </h1>
        <div class="w-full flex items-center">
            <div>
                {{Form::open(['route' => 'tasks.index', 'method' => 'GET'])}}
                    <div class="flex">
                        <div>
                            {{Form::select('filter[status_id]', $taskStatuses, $filter['status_id'] ?? null, ['placeholder' => __('layout.table_task_status'), 'class' => 'form-select ml-2 rounded border-gray-300'])}}                        </div>
                        <div >
                            {{Form::select('filter[created_by_id]', $users, $filter['created_by_id'] ?? null, ['placeholder' => __('layout.table_creater'), 'class' => 'form-select ml-2 rounded border-gray-300'])}}                        </div>
                        <div>
                            {{Form::select('filter[assigned_to_id]', $users, $filter['assigned_to_id'] ?? null, ['placeholder' => __('layout.table_assigned'), 'class' => 'form-select ml-2 rounded border-gray-300'])}}
                        </div>
                        <div>
                            {{Form::submit(__('layout.create_apply'), ['class' => 'ml-2 rounded bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'])}}
                        </div>

                    </div>
                {{Form::close()}}
            </div>
            <div class="ml-auto">
            </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    @auth()
                    @csrf
                    <a href="{{ route('tasks.create') }}"
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('layout.create_button_task') }}           </a>
                    @endauth
                </div>
        </div>
        <table class="mt-4">
            <thead class="border-b-2 border-solid border-black text-left" style="text-align: left">
            <tr>
                <th>{{ __('layout.table_id') }}</th>
                <th>{{ __('layout.table_task_status') }}</th>
                <th>{{ __('layout.table_name') }}</th>
                <th>{{ __('layout.table_creater') }}</th>
                <th>{{ __('layout.table_assigned') }}</th>
                <th>{{ __('layout.table_date_of_creation') }}</th>
                @auth()
                    <th>{{ __('layout.table_actions') }}</th>
                @endauth
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr class="border-b border-dashed text-left">
                    <td>{{ $task->id }}</td>
                    <td>{{ $taskStatuses[$task->status_id] }}</td>
                    <td><a href="{{ route('tasks.show', $task) }}">{{ $task->name }}</a></td>
                    <td>{{ $users[$task->created_by_id] }}</td>
                    <td>{{ $users[$task->assigned_to_id] }}</td>
                    <td>{{ date_format($task->created_at, 'd.m.Y') }}</td>
                    @auth()
                        <td>
                            @can('delete', $task)
                            <a
                                class="text-red-600 hover:text-red-900"
                                rel="nofollow"
                                data-method="delete"
                                data-confirm="{{ __('layout.table_delete_question') }}"
                                href="{{ route('tasks.destroy', $task) }}"
                            >
                                {{ __('layout.table_delete') }}
                            </a>
                            @endcan
                            @can('update', $task)
                            <a class="text-blue-600 hover:text-blue-900"
                               href="{{ route("tasks.edit", $task) }}"
                            >
                                {{ __('layout.table_edit') }}
                            </a>
                                @endcan
                        </td>
                    @endauth
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @auth()
        <div class="mt-4 grid col-span-full">{{ $tasks->links() }}</div>
    @endauth
@endsection
