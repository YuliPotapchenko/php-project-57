@extends('layouts.app')

@section('h1')
    {{ __('taskStatus.create_status') }}
@endsection

@section('content')
    {{ Form::open(['url' => route('task_statuses.store'), 'method' => 'POST', 'class' => 'w-50']) }}
    @include('task_statuses.form')
    {{ Form::submit(__('taskStatus.create'), ['class' => "btn btn-primary"]) }}
    {{ Form::close()}}
@endsection
