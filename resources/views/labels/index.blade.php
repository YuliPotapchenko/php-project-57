@extends('layouts.app')

@section('h1')
    {{ __('label.title') }}
@endsection

@section('content')
    @if (Auth::user())
    <a href="{{ route('labels.create')}}" class="btn btn-primary">
        {{ __('label.create_label') }}
    </a>
    @endif
    <table class="table mt-2">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{ __('label.name') }}</th>
                <th>{{ __('label.description') }}</th>
                <th>{{__('label.created_at')}}</th>
                @auth
                <th>{{ __('label.actions') }}</th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach ($labels as $label)
            <tr>
                <td>{{ $label->id }}</td>
                <td>{{ $label->name }}</td>
                <td>{{ $label->description }}</td>
                <td>{{ date('d.m.Y', strtotime($label->created_at)) }}</td>
                <td>
                    @auth
                        <a class="text-danger" href="{{ route('labels.destroy', $label->id)}}" data-confirm="{{ __('messages.alert.confirm') }}" data-method="delete" rel="nofollow">
                            {{ __('label.delete') }}
                        </a>
                        <a href="{{ route('labels.edit', $label->id) }}">
                            {{ __('label.change') }}
                        </a>
                    @endauth
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <nav aria-label="navigation">
        {{ $labels->links("pagination::bootstrap-4") }}
    </nav>
@endsection
