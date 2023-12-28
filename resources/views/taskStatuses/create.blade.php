@extends('layouts.app')
@section('content')

@auth()
    <div class="grid col-span-full">
        <h1 class="max-w-2xl mb-4 text-4xl leading-none tracking-tight md:text-5xl xl:text-6xl dark:text-white">{{ __('layout.task_statuses_create') }}</h1>

        {{ Form::open(['url' => route('task_statuses.store'), 'method' => 'POST', 'class' => 'w-50']) }}
        <div class="flex flex-col">
            <div>
                {{ Form::label('name', __('layout.table_name')) }}
            </div>
            <div class="mt-2">
                {{ Form::text('name', '', ['class' => 'form-control rounded border-gray-300 w-1/3']) }}
            </div>
            <div>
                @if ($errors->any())
                    {{ $errors->first('name') }}
                @endif
            </div>
            <div class="mt-2">
                {{ Form::submit(__('layout.create_button'), ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endauth

@endsection
