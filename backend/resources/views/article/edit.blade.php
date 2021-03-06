@extends('layout.master')

@section('main')


    <div class="container mt-4">
        <div class="border p-4">
            <h1 class="h5 mb-4">
                記事の編集
                <form class="card-body" action="{{ route('Art.destroy') }}" method="POST">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $article['id']  }}">
                    <button type="submit">削除</button>
                </form>
            </h1>

            <form method="POST" action="{{ route('Art.update') }}">
                @csrf
                <!-- 更新のeditメソッドを実行するのに実行するのに、question id のものを編集するかわかるようにpost時の連想配列に追加 -->
                <input type="hidden" name="article_id" value="{{ $article['id']  }}">

                <fieldset class="mb-4">
                    <div class="form-group">
                        <label for="title">
                            タイトル
                        </label>
                        <input id="title" name="title" class="form-control " value="{{$article['title']}}" type="text">
                            <div class="invalid-feedback">
                            </div>
                    </div>

                    <div class="form-group">
                        <label for="content">
                            本文
                        </label>
                        <textarea id="content" name="content" class="form-control" rows="4">
                            {{$article['content']}}
                        </textarea>
                            <div class="invalid-feedback">
                            </div>
                    </div>

                    <div class="mt-5">
                        <a class="btn btn-secondary" href="">
                            キャンセル
                        </a>
                        <button type="submit" class="btn btn-primary">
                            更新する
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection