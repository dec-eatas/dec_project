@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="mb-4">
            <a href="{{ route('questions.create') }}" class="btn btn-primary">
                投稿を新規作成する
            </a>
        </div>
        @foreach ($questions as $question)
            <div class="card mb-4">
                <div class="card-header">
                    {{ $question->title }}
                </div>

@section('content')
    <div class="container mt-4">
        @foreach ($questions as $question)
            <div class="card mb-4">
                <div class="card-header">
                    {{ $question->title }}
                </div>
                <div class="card-body">
                    <p class="card-text">
                        {!! nl2br(e(str_limit($question->content, 300))) !!}
                    </p>
                </div>
                <div class="card-footer">
                    <span class="mr-2">
                        投稿日時 {{ $question->created_at->format('Y.m.d') }}
                    </span>

                    @if ($question->answers->count())
                        <span class="badge badge-primary">
                            コメント {{ $question->answers->count() }}件
                        </span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <div class="card-body">
        <p class="card-text">
                {!! nl2br(e(str_limit($question->body, 200))) !!}
        </p>
        <a class="card-link" href="{{ route('questions.show', ['question' => $question]) }}">
                続きを読む
        </a>
</div>
    <div class="d-flex justify-content-center mb-5">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
