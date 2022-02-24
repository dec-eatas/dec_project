<?php

namespace App\Http\Controllers;

use App\Services\ListService;
use App\Models\Article;
use App\Models\Tag;
use App\Models\ArticleTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\UseCases\Article\IndexAction;
use App\UseCases\Article\CreateAction;
use App\UseCases\Article\SearchTitleAction;
use App\UseCases\Article\StoreAction;
use App\UseCases\Article\ShowAction;
use App\UseCases\Article\UpdateAction;
use App\UseCases\Article\DeletedAction;

class ArticlesController extends Controller
{

    public function index(IndexAction $obj)
    {
        return view('article.index',$obj());
    }

    public function search_title(Request $request,SearchTitleAction $obj)
    {   
        return view('article.index',$obj($request));
    }
    

    public function create(CreateAction $obj)
    {
        return view('article.create',$obj());
    }

    public function store(Request $request,StoreAction $obj)  // 記事をDBに追加(DB)
    {
        return redirect( route('Art.show',$obj($request)));
    }

    public function show(Request $request,ShowAction $obj)
    {
        return view('article.show',$obj($request));
    }

    // public function edit(Request $request,EditAction $obj)
    // {
    //     return view('article.edit',$obj($request));
    // }



    // // ⬇︎記事を編集した内容をDBに保存(DB)
    // public function update(Request $request,UpdateAction $obj)
    // {
    //     return redirect(route('Art.home',$obj($request)));
    // }



    // public function destroy(Request $request)
    // {
    //     $obj($request);
    //     return redirect( route('Art.home'));

    // }

}
