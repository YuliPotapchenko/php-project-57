@extends('layouts.app')

@section('h1')
    {{ __('label.change_label') }}
@endsection

@section('content')
    {{ Form::model($label, ['url' => route('labels.update', $label->id), 'method' => 'PATCH', 'class' => 'w-50']) }}
    @include('labels.form')
    {{ Form::submit(__('label.update'), ['class' => "btn btn-primary"]) }}
    {{ Form::close()}}
@endsection
