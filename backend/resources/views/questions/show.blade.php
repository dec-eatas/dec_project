@extends('layout.master')


@section('main')

    <div class="container mt-4">
        <div class="border p-4">
            <h1 class="h5 mb-4">
                投稿の詳細
            </h1>
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="/question/{{ $show_question['id'] }}/edit" class="text-sm text-gray-700 dark:text-gray-500 underline">編集</a>
                    @else
                        <span>no edit</span>
                    @endauth
                </div>
            @endif



            @csrf
            <!-- 更新のeditメソッドを実行するのに実行するのに、question id のものを編集するかわかるようにpost時の連想配列に追加 -->
            <input type="hidden" name="question_id" value="{{ $show_question['id']  }}">

            <div class="form-group">
                <h3>タイトル</h3>
                <span name="title">{{$show_question['title']}}</span>
            </div>

            <div class="form-group">
                <h3>本文</h3>
                <span name="content">{{$show_question['content']}}</span>
            </div>
        </div>
    </div>

@endsection


