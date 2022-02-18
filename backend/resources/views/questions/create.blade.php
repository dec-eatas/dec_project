@extends('layout.master')

@section('main')
    <div class="container mt-4">
        <div class="border p-4">
            <h1 class="h5 mb-4">
                質問の新規作成
            </h1>
            <form action="{{route('Que.store')}}" method="POST">
                @csrf
                <div>
                    <p>タイトル</p>
                    <input type="text" name="title" size="25" value="">
                </div>

                <div>
                    <p>内容</p>
                    <textarea name="content" cols="100" rows="5"></textarea>
                </div>

                <p><input type="submit" value="送信"></p>

            </form>
        </div>
    </div>
@endsection