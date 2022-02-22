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
    .side_btns{
        width:100%;padding-bottom:0.5em;}
    .side_btns button{
        width:100%;font-size:0.8em;padding:0.5em 0;border:lightgray solid;border-width:0.5px;}
   

</style>

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

@include('components.main.question',['content'=>$que_list,'question',$question])
@include('components.main.form_confirm',['confirms'=>$confirms,'next'=>'Ans.store','back'=>'Ans.back'])

@endsection
