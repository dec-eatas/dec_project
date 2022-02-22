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

    {!! Form::open(['method'=>'get', 'route' => ['SearchService.index']]) !!}
 
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-sm-4">
                    {!! Form::label('status', 'Status') !!}
                    {!! Form::select('status', [null => 'すべて', '0' => '未対応', '1' => '処理中', '2' => '処理済み', '3' => '完了'], '', ['class' => 'form-control custom-select']) !!}
                </div>
                <div class="form-group col-sm-2 mt-4 pt-2">
                    {!! Form::hidden('sort', $sort, ['class' => 'form-control']) !!}
                    {!! Form::submit('Search', ['class' => 'btn btn-primary btn-block']) !!}
                </div>
            </div>
        </div>
    </div>

 {!! Form::close() !!}

@endsection

@section('main')

@include('components.main.list',['contents' => $questions])

@endsection