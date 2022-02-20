@extends('layout.master')

@section('main')


    <div class="container mt-4">
        <div class="border p-4">
            <h1 class="h5 mb-4">
                記事の詳細
                {{-- <form class="card-body" action="{{ route('Artdestroy') }}" method="POST">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $edit_article['id']  }}">
                    <button type="submit">削除</button> --}}
                {{-- </form> --}}
            </h1>

            {{-- <form method="POST" action="{{ route('Artupdate') }}">
                @csrf --}}
                <!-- 更新のeditメソッドを実行するのに実行するのに、question id のものを編集するかわかるようにpost時の連想配列に追加 -->
                {{-- <input type="hidden" name="article_id" value="{{ $edit_article['id']  }}"> --}}

                <fieldset class="mb-4">
                    <div class="form-group">
                        <label for="title">
                            タイトル
                        </label>
                        <input id="title" name="title" class="form-control " value="{{$article->title}}" type="text">
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

                    {{-- z--}}
                        <form action="{{ route('Art.edit') }}" method="post" >
                            @csrf
                            <input type="hidden" name="title" value="{{ $article->title }}">
                            <input type="hidden" name="content" value="{{ $article['content'] }}">
                            <input type="hidden" name="id" value="{{ $article['id'] }}">

                        <button type="submit" class="btn btn-primary">
                            編集する
                        </button>
                        </form>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection