@extends('layout.master')
<style>

    .component{
        background-color:white;width:100%;padding:0.5em 1em;margin-bottom:0.5em;
        border:lightgray solid;border-width:0.5px;}
        .component_title{
        width:100%;text-align:center;font-size:1em;padding:0.8em 0;border-bottom:solid lightgray;
        border-width:0.5px;white-space:nowrap;text-overflow:ellipsis;overflow:hidden;}
    .input_box{
        width:100%;padding:0.8em 0;}
    .input{
        width:100%;font-size:1em}
    .subject{
        width:100%;font-size:0.8em;}
    .eval{
        width:50%;font-size:0.8em;padding:0.5em 0;text-align:center}
    .side_btns{
        width:100%;padding-bottom:0.5em;}
    .side_btns button{
        width:100%;font-size:0.8em;padding:0.5em 0;border:lightgray solid;border-width:0.5px;}
    .side_list_content{
        width:100%;padding:0.8em 0;}
    .side_list_record{
        width:100%;padding:0.3em 0;font-size:0.8em;
        white-space:nowrap;text-overflow:ellipsis;overflow:hidden;}

</style>

@section('title','トップページ')

@section('side')
    <div class="component">
        <div class="component_title">
            記事を検索する
        </div>
        <div class="input_box">
            <label class="subject">キーワード</label>
            <input type="text" name="keyword" class="input">
        </div>

        <div class="side_btns">
            <button onclick="location.href='index'">検索</button>
        </div>
    </div>
@endsection

@section('main')
    @foreach($articles as $article)
    <div class="component">
        <div class="list_status">
            <div class="list_category">{{ $category ?? 'カテゴリー' }}</div>
            <div class="list_tags">
                @foreach($tags ?? ['タグ1あああああいいいい','2','3','4','5'] as $tag)
                <div class="list_tag">
                    <a>{{ $tag }}</a>
                </div>
                @endforeach
            </div>
            <div class="list_reaction">♡ {{ $reaction ?? '∞' }}</div>
            <div class="list_comment">💬 {{ $comment ?? '∞' }}</div>
            <div class="list_datetime">{{ $datetime ?? '2022/02/15' }}</div>
        </div>
        <p>-----------------------------------------</p>
        <div class="list_content">
            <div class="list_type type_{{ $type ?? 'Question' }}">{{ $type ?? 'Question' }}</div>
            <a href="article/edit/{{$article['id']}}" class="card-text d-block">{{$article['title']}}</a><br>
            <a href="article/edit/{{$article['id']}}" class="card-text d-block">{{$article['content']}}</a><br>
            <div class="list_title">{{ $title ?? 'これは質問のタイトルです。' }}</div>
            <!-- ↓追加 -->
                    <!-- favorite 状態で条件分岐 -->
                    @if($article->users()->where('user_id', Auth::id())->exists())
                    <!-- unfavorite ボタン -->
                    <form action="{{ route('unfavorites',$article) }}" method="POST" class="text-left">
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
    </div>
    @endforeach
@endsection