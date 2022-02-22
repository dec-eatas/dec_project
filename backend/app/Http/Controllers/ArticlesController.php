<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticlesController extends Controller
{
    
    public function index()
    {
        $articles = Article::select('articles.*')
        ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();
        // dd($articles);
        //ここでデータを取得
        return view('article.index', compact('articles'));

    }

    
    public function create()
    {
        return view('article.create');
    }


    public function store(Request $request)  // 記事をDBに追加(DB)
    {
        $article = $request->all();
        //dd(auth()->id());dd(\Auth::id());dd(auth()->id());dd($article);
        Article::insert([
            'title' => $article['title'],
            'content' =>$article['content'],
            'user_id' => auth()->id()
        ]);
    
        return redirect( route('Art.create'));
    }


   
    public function show($id)
    {
        
        $article = Article::find($id);
        //dd($article);
        return view('article.show', compact('article'));
    }

    public function edit(Request $request)
    {
        $data = $request->only(['id','title','content']);
        $article = [
            'id' => $data['id'],
            'title' => $data['title'],
            'content' => $data['content'],
        ];

        return view('article.edit', compact('article'));
    }


    // ⬇︎記事を編集した内容をDBに保存(DB)
    public function update(Request $request)
    {
        $posts = $request->all();
        //dd($posts);
        Article::where('id',$posts['article_id'])
            ->update([
                'content' => $posts['content'],
                'title' => $posts['title']
            ]);

        return redirect( route('Art.home'));

    }


    public function destroy(Request $request)
    {
        $posts = $request->all();
        // dd($posts);
        //論理削除
        Article::where('id',$posts['article_id'])->update(['deleted_at' => date("Y-m-d H:i:s", time())]);
        return redirect( route('Art.home'));

    }
}
