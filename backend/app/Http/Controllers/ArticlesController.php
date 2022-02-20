<?php

namespace App\Http\Controllers;

use App\Models\Article;
//use App\Models\Topic; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticlesController extends Controller
{
    // ⬇記事一覧画面の表示
    public function index()
    {
        //ここでデータを取得
        $articles = Article::select('articles.*')
        
        ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();
        // dd($articles);

        return view('article.index', compact('articles'));
    }

    // ⬇︎記事詳細画面の表示 public function detail関数の定義(Request $request)引数
    //詳細表示は、articleで単数で　記事一覧の時は、articlesで複数形に


    //⬇︎記事の作成(view)
    public function create()
    {
        return view('article.create');
    }


    // 記事をDBに追加(DB)
    public function store(Request $request)
    {
        $article = $request->all();
        //dd(auth()->id());

        // dd(\Auth::id());//🟡[error]DBに入れる質問を作成したユーザー（ログインしているユーザ）のidを取得したいがエラー 🟡 レンレンが使ってるAuth::user()も同じことかな？ -> こっちのメソッドはユーザー名を取得か
        // dd(auth()->id());// [knowledge sharing]こっちだとログインしてるuser_idを取れる。ログインしてないとNull。
        // dd($question);
        // ⬇︎[needs modifing]DBに格納される値に’’が入ってしまうので、ここの配列に代入してる値修正した方いい。＝＞
        Article::insert([
            'title' => $article['title'],
            'content' =>$article['content'],
            'user_id' => auth()->id()
        ]);
    // 🟡[needs update] 質問を作成した後なので,投稿詳細画面に飛ぶようにする
    return redirect( route('Art.create'));
    }



    public function show($id)
    {

        $article = Article::find($id);
        //dd($article);
        return view('article.show', compact('article'));
    }

    




    // ⬇︎記事の編集(view)(現在一覧画面(index.blade)のタイトルと本文がaタグになっていていてそこから編集に飛ぶ感じになってます)
    // 🟡[needs modifing]あと、この機能は、ログインしてるユーザー本人の質問内容のみ編集できるようにしないとダメ。
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


    //🟡[needs Reconciling perceptions] ditail()がなんなのかわからない。web.phpに詳細あり。レンレン見てたら確認お願い。
}
