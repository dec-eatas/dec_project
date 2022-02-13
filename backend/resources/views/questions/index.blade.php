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

<div class="component">
    <div class="component_title">
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
    <div class="component_title">
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