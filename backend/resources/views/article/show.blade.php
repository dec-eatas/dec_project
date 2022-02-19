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
 @section('content')
    <div class="container mt-4">
        <div class="border p-4">
            <div class="mb-4 text-right">
                <a class="btn btn-primary" href="{{ route('questions.edit', ['question' => $question]) }}">
                    編集する
                </a>
                <form style="display: inline-block;" method="POST" action="{{ route('questions.destroy', ['question' => $question]) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">削除する</button>
                </form>
            </div>
            <h1 class="h5 mb-4">
                {{ $question->title }}
            </h1>

            <p class="mb-5">
                {!! nl2br(e($question->content)) !!}
            </p>
            <section>
                <h2 class="h5 mb-4">
                    コメント
                </h2>

                @forelse($question->answers as $answer)
                    <div class="border-top p-4">
                        <time class="text-secondary">
                            {{ $answer->created_at->format('Y.m.d H:i') }}
                        </time>
                        <p class="mt-2">
                            {!! nl2br(e($answer->body)) !!}
                        </p>
                    </div>
                @empty
                    <p>コメントはまだありません。</p>
                @endforelse
            </section>
        <form class="mb-4" method="POST" action="{{ route('answer.store') }}">
            @csrf

            <input name="question_id" type="hidden" value="{{ $question->id }}">

            <div class="form-group">
                <label for="body">
                    本文
                </label>

                <textarea id="body" name="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" rows="4">{{ old('body') }}</textarea>
                @if ($errors->has('body'))
                    <div class="invalid-feedback">
                        {{ $errors->first('body') }}
                    </div>
                @endif
            </div>