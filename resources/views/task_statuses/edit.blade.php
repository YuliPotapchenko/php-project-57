@extends('layouts.app')

@section('h1')
    {{ __('taskStatus.change_status') }}
@endsection

@section('content')
    {{ Form::model($taskStatus, ['url' => route('task_statuses.update', $taskStatus->id), 'method' => 'PATCH', 'class' => 'w-50']) }}
    @include('task_statuses.form')
    {{ Form::submit(__('taskStatus.update'), ['class' => "btn btn-primary"]) }}
    {{ Form::close()}}
@endsection
