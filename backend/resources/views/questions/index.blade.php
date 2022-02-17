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
            質問を検索する
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
    @foreach($questions as $question)
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
            <a href="edit/{{$question['id']}}" class="card-text d-block">{{$question['title']}}</a><br>
            <a href="edit/{{$question['id']}}" class="card-text d-block">{{$question['content']}}</a><br>
            <div class="list_title">{{ $title ?? 'これは質問のタイトルです。' }}</div>
        </div>
    </div>
    @endforeach
@endsection