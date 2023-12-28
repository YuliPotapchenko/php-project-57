@extends('layouts.app')

@section('h1')
    {{ __('task.create_task') }}
@endsection

@section('content')
    {{ Form::open(['url' => route('tasks.store'), 'method' => 'POST', 'accept-charset' => "UTF-8", 'class' => 'w-50']) }}
    @include('tasks.form')
    {{ Form::submit(__('task.create'), ['class' => "btn btn-primary my-3"]) }}
    {{ Form::close() }}
@endsection
