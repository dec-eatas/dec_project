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
                        <!-- ↓追加 -->
                    <!-- favorite 状態で条件分岐 -->
                    @if($article->users()->where('user_id', Auth::id())->exists())
                    <!-- unfavorite ボタン -->
                    <form action="{{ route('un.favorites',$article) }}" method="POST" class="text-left">
                      @csrf
                      <button type="submit" class="flex mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-red py-1 px-2 focus:outline-none focus:shadow-outline">
                        <svg class="h-6 w-6 text-red-500" fill="red" viewBox="0 0 24 24" stroke="red">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        {{ $article->users()->count() }}
                      </button>
                    </form>
                    @else
                    <!-- favorite ボタン -->
                    <form action="{{ route('favorites',$article) }}" method="POST" class="text-left">
                      @csrf
                      <button type="submit" class="flex mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-black py-1 px-2 focus:outline-none focus:shadow-outline">
                        <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="black">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        {{ $article->users()->count() }}
                      </button>
                    </form>
                    @endif
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection