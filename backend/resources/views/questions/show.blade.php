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
@include('components.side.hyper_search',['route'=>'Que.hyper'])
@include('components.side.create',['route'=>'Que.create'])
@include('components.side.trend',['trend' => $trend['que_tags']])
@endsection



@section('main')

@include('components.main.parent',['content'=>$que_list,'parent'=>$favorites['parent']])
@include('components.main.ans_input',['content'=>$que_list,'answer'=>$ans_confirm])
@include('components.main.child',['contents'=>$ans_list,'child'=>$favorites['child'],$i])

@endsection
