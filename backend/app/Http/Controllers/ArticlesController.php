<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\UseCases\Article\IndexAction;
use App\UseCases\Article\StoreAction;
use App\UseCases\Article\ShowAction;
use App\UseCases\Article\EditAction;
use App\UseCases\Article\UpdateAction;
use App\UseCases\Article\DestoryAction;

class ArticlesController extends Controller
{
    
    public function index(IndexAction $obj)
    {
        return view('article.index',$obj());
    }
    
    public function create()
    {
        return view('article.create');
    }

    public function store(Request $request,StoreAction $obj)  // 記事をDBに追加(DB)
    {
        return redirect(route('Art.show',$obj($request)));
    }

    public function show(Request $request,ShowAction $obj)
    {
        return view('article.show',$obj($request));
    }

    public function edit(Request $request,EditAction $obj)
    {
        return view('article.edit',$obj($request));
    }

    // ⬇︎記事を編集した内容をDBに保存(DB)
    public function update(Request $request,UpdateAction $obj)
    {
        return redirect(route('Art.home',$obj($request)));
    }


    public function destroy(Request $request,DestroyAction $obj)
    {
        $obj($request);
        return redirect( route('Art.home'));

    }
}
