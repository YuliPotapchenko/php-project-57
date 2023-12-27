@extends('layouts.app')

@section('content')
    <main class="container-fluid py-5">
        <div class="p-5 mb-4 bg-light border rounded-3">
            <div class="jumbotron">
                <h1 class="display-4"> {{__('index.Hello_from_Hexlet!')}} </h1>
                <p class="lead"> {{__('index.Practical_programming_courses')}} </p>
                <a class="btn btn-primary btn-lg" href="https://hexlet.io" role="button"> {{__('index.Learn_more')}}</a>
            </div>
        </div>
    </main
@endsection
