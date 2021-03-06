<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\UseCases\Question\IndexAction;
use App\UseCases\Question\SearchTitleAction;
use App\UseCases\Question\TagSearchAction;
use App\UseCases\Question\HyperAction;
use App\UseCases\Question\CreateAction;
use App\UseCases\Question\ShowAction;
use App\UseCases\Question\StoreAction;
use App\UseCases\Question\EditAction;
use App\UseCases\Question\UpdateAction;
use App\UseCases\Question\DestroyAction;


class QuestionsController extends Controller
{

    public function index(Request $request,IndexAction $obj)
    {
        return view('questions.index',$obj($request));
    }

    public function search_title(Request $request,SearchTitleAction $obj)
    {   //urlパラメーターとしてのkeywordが取れる
        return view('questions.index',$obj($request));
    }

    public function hyper(Request $request,HyperAction $obj)
    {
        return redirect('article.index',$obj($request));
    }

    public function create(Request $request,CreateAction $obj)
    {
        return view('questions.create',$obj($request));
    }

    
    public function store(Request $request,StoreAction $obj)
    {       
        return redirect(route('Que.show',$obj($request)));
    }

    public function show(Request $request,ShowAction $obj)
    {    
        return view('questions.show',$obj($request));
    }
    
    public function edit(Request $request,EditAction $obj)
    {
        return view('questions.edit',$obj($request));
    }

    public function update(Request $request,UpdateAction $obj)
    {
        return redirect(route('Que.show',$obj($request)));
    }

    public function destroy(Request $request,DestroyAction $obj)
    {
        $obj($request);
        return redirect(route('Que.home'));
    }

}