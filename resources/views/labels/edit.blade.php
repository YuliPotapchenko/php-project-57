@extends('layouts.app')
@section('content')

    @auth()
        <div class="grid col-span-full">
            <h1 class="max-w-2xl mb-4 text-4xl leading-none tracking-tight md:text-5xl xl:text-6xl dark:text-white">{{ __('layout.label_edit') }}</h1>

            {{ Form::open(['url' => route('labels.update', $label), 'method' => 'PATCH', 'class' => 'w-50']) }}
            <div class="flex flex-col">
                <div>
                    {{ Form::label('name', __('layout.table_name')) }}
                </div>
                <div class="mt-2">
                    {{ Form::text('name', $label->name, ['class' => 'form-control rounded border-gray-300 w-1/3']) }}
                </div>
                <div>
                    @if ($errors->any())
                        {{ $errors->first('name') }}
                    @endif
                </div>
                <div class="mt-2">
                    {{ Form::label('name', __('layout.table_description')) }}
                </div>
                <div class="mt-2">
                    {{ Form::textarea('description', $label->description, ['class' => 'form-control rounded border-gray-300 w-1/3 h-32', 'cols' => '50', 'rows' => '10']) }}
                </div>
                @if ($errors->any())
                    {{ $errors->first('description') }}
                @endif
                <div class="mt-2">
                    {{ Form::submit(__('layout.update_button'), ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}
                </div>
            </div>
            {{ Form::close() }}

        </div>
    @endauth

@endsection
