@extends('layout.master')


@section('main')

    <div class="container mt-4">
        <div class="border p-4">
            <h1 class="h5 mb-4">
                投稿の詳細
                <form class="card-body" action="{{ route('Que.destroy') }}" method="POST">
                    @csrf
                    <input type="hidden" name="question_id" value="{{ $show_question['id']  }}">
                    <button type="submit">削除</button>
                </form>
            </h1>


            @csrf
            <!-- 更新のeditメソッドを実行するのに実行するのに、question id のものを編集するかわかるようにpost時の連想配列に追加 -->
            <input type="hidden" name="question_id" value="{{ $show_question['id']  }}">

            <div class="form-group">
                <q>タイトル</q>
                <span name="title">{{$show_question['title']}}</span>
            </div>

            <div class="form-group">
                <p>本文</p>
                <span name="content">{{$show_question['content']}}</span>
            </div>
        </div>
    </div>

@endsection


