@extends('layout.master')


@section('side')
@yield('create_answer')
@endsection


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

            <div class="form-group">
                <h3>タイトル</h3>
                <span name="title">{{$show_question['title']}}</span>
            </div>

            <div class="form-group">
                <h3>本文</h3>
                <span name="content">{{$show_question['content']}}</span>
            </div>
        </div>
<p>-----------------------------------------</p>
    <div>
        <!-- 回答作成は画面に飛ぶか、ここで作成した反映するか？今後のことを考えると自分が回答したものをコンポーネント化して表示されていればおけ -->
        <!-- kaitou作成は埋め込む形にするように、@extendでブレードファイルをつくって送る形がいい -->

        <div class="border p-4">
            <h2 class="h5 mb-4">
                回答作成
            </h2>
            <form action="{{ route('Ans.store') }}" method="POST">
                
                @csrf
                <!-- 埋め込まれるまえにvalueの中身が送られてくる -->
                <input type="hidden" name="question_id" value="{{$show_question['id']}}">
                <div>
                    <p>内容</p>
                    <textarea name="content" cols="100" rows="5"></textarea>
                </div>

                <p><input type="submit" value="送信"></p>

            </form>
        </div>
<p>-------------------------------------------</p>
        <h3>回答の一覧</h3>
        @foreach($answers as $answer)
    <div class="component">
        <div class="list_content">
            <div class="list_type type_{{ $type ?? 'Question' }}">{{ $type ?? 'Question' }}</div>
            <a href="/question/{{ $answer['id'] }}/edit" class="card-text d-block">{{$answer['content']}}</a><br>
            <p>ここに回答してユーザの名前が欲しい。answerのDB設計もう一度</p>
            <div class="list_title">{{ $title ?? 'これは質問のタイトルです。' }}</div>
            <p>------------------------</p>
        </div>
    </div>
    @endforeach

    </div>
    </div>

@endsection


