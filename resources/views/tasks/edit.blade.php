@extends('layouts.app')
@section('content')

    @auth()
        <div class="grid col-span-full">
            <h1 class="max-w-2xl mb-4 text-4xl leading-none tracking-tight md:text-5xl xl:text-6xl dark:text-white">{{ __('layout.tasks_edit') }}</h1>

            {{ Form::open(['url' => route('tasks.update', $task), 'method' => 'PATCH', 'class' => 'w-50']) }}
            <div class="flex flex-col">
                <div>
                    {{ Form::label('name', __('layout.table_name')) }}
                </div>
                <div class="mt-2">
                    {{ Form::text('name', $task->name, ['class' => 'form-control rounded border-gray-300 w-1/3']) }}
                </div>
                <div>
                    @if ($errors->any())
                        {{ $errors->first('name') }}
                    @endif
                </div>
                <div class="mt-4">
                    {{ Form::label('description', __('layout.table_description')) }}
                </div>
                <div class="mt-2">
                    {{ Form::textarea('description', $task->description, ['class' => 'rounded border-gray-300 w-1/3 h-32']) }}
                </div>
                @if ($errors->any())
                    {{ $errors->first('description') }}
                @endif
                <div class="mt-4">
                    {{ Form::label('status_id', __('layout.table_status')) }}
                </div>
                <div class="mt-2">
                    {{ Form::select('status_id', $statuses, $task->status_id, ['class' => 'form-control rounded border-gray-300 w-1/3', 'placeholder' => '----------']) }}
                </div>
                @if ($errors->any())
                    {{ $errors->first('status_id') }}
                @endif
                <div class="mt-4">
                    {{ Form::label('assigned_to_id', __('layout.table_assigned')) }}
                </div>
                <div class="mt-2">
                    {{ Form::select('assigned_to_id', $users, $task->assigned_to_id, ['class' => 'form-control rounded border-gray-300 w-1/3', 'placeholder' => '----------']) }}
                </div>
                @if ($errors->any())
                    {{ $errors->first('assigned_to_id') }}
                @endif
                <div class="mt-4">
                    {{ Form::label('labels', __('layout.labels')) }}
                </div>
                <div class="mt-2">
                    {{ Form::select('labels[]', $labels, $task->labels, ['class' => 'form-control rounded border-gray-300 w-1/3 h-32', 'multiple' => 'multiple', 'placeholder' => '']) }}
                </div>
                <div class="mt-4">
                    {{ Form::submit(__('layout.update_button'), ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    @endauth

@endsection
