@extends('layout.master')
<style>

    .component{
        background-color:white;width:100%;padding:0.5em 1em;margin-bottom:0.5em;
        border:lightgray solid;border-width:0.5px;}
    #user_name,.side_list_title{
        width:100%;text-align:center;font-size:1em;padding:0.8em 0;border-bottom:solid lightgray;
        border-width:0.5px;white-space:nowrap;text-overflow:ellipsis;overflow:hidden;}
    #eval_box{
        width:100%;display:flex;flex-wrap:wrap;padding:0.8em 0;}
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
    <div id="user_name">
        ユーザー
    </div>
    <div id="eval_box">
        <div class="eval">質問数 {{ 1 }}</div>
        <div class="eval">回答数 {{ 1 }}</div>
        <div class="eval">記事数 {{ 1 }}</div>
        <div class="eval">閲覧数 {{ 1 }}</div>
        <div class="eval">反応数 {{ 1 }}</div>
        <div class="eval">参考数 {{ 1 }}</div>
    </div>
    <div class="side_btns">
        @if(1==0)
            <button>フォローする</button>
        @elseif(1==2)
            <button>フォローを外す</button>
        @else
            <button onclick="location.href='eata'">詳細を見る</button>
        @endif
    </div>
</div>

<div class="component">
    <div class="side_list_title">
        フォローリスト
    </div>
    <div class="side_list_content">
        <div class="side_list_record"><a href="eata">トーマス・アルバ・エジソン</a></div>
        <div class="side_list_record"><a href="eata">アルベルト・アインシュタイン</a></div>
        <div class="side_list_record"><a href="eata">レオナルド・ダ・ヴィンチ</a></div>
        <div class="side_list_record"><a href="eata">ガリレオ・ガリレイ</a></div>
        <div class="side_list_record"><a href="eata">サー・アイザック・ニュートン</a></div>
    </div>
    <div class="side_btns">
        <button onclick="location.href='eata'">もっと見る</button>
    </div>
</div>

<div class="component">
    <div class="side_list_title">
        フォロワーリスト
    </div>
    <div class="side_list_content">
        <div class="side_list_record"><a href="eata">ヨハン・ゼバスティアン・バッハ</a></div>
        <div class="side_list_record"><a href="eata">ルードヴィヒ・ヴァン・ベートーヴェン</a></div>
        <div class="side_list_record"><a href="eata">ヴォルフガング・アマデウス・モーツァルト</a></div>
        <div class="side_list_record"><a href="eata">フランツ・シューベルト</a></div>
        <div class="side_list_record"><a href="eata">フレデリック・ショパン</a></div>
    </div>
    <div class="side_btns">
        <button onclick="location.href='eata'">もっと見る</button>
    </div>
</div>

@endsection

@section('main')



@endsection