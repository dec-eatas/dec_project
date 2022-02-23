@extends('layout.master')

@section('main')
@include('components.main.parent',['content'=>$art_list,'parent'=>$favorites['parent']])
@endsection