@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="border p-4">
            <h1 class="h5 mb-4">
                {{ $question->title }}
            </h1>

            <p class="mb-5">
                {!! nl2br(e($question->body)) !!}
            </p>
        </div>
    </div>
@endsection
