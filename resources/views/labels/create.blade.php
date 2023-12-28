@extends('layouts.app')

@section('h1')
    {{ __('label.create_label') }}
@endsection

@section('content')
    {{ Form::open(['url' => route('labels.store'), 'method' => 'POST', 'class' => 'w-50']) }}
    @include('labels.form')
    {{ Form::submit(__('label.create'), ['class' => "btn btn-primary"]) }}
    {{ Form::close()}}
@endsection
