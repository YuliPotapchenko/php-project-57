@extends('layouts.app')

@section('h1')
    {{ __('task.view_task')}}: {{ $task->name}}
    @auth
        <a href="{{ route('tasks.edit', $task->id) }}"> ⚙ </a>
    @endauth
@endsection

@section('content')
    <p>{{ __('task.name') }}: {{ $task->name }}</p>
    <p>{{ __('task.status') }}: {{ $task->status->name }}</p>
    <p>{{ __('task.description') }}: {{ $task->description}}</p>
        <p>{{ __('task.labels') }}:</p>
        <ul>
            @foreach ($task->labels->all() as $label)
                <li>{{ $label['name'] }}</li>
            @endforeach
        </ul>
@endsection
