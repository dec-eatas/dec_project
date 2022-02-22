<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use App\Models\ArticleTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            // dd(Auth::id());
            //dd(auth()->id());dd(\Auth::id());dd(auth()->id());dd($article);

        // タグ追加機能 ⬇︎機能要件整理
        //  画面：インプット欄がある。入力したタグが表示される。△チェックボックスで追加か書き込んだらタグが表示されていく形、△すでに存在しているタグかわかる、
        // 機能：全ての人が共通のタグを利用。タグからデータを活用するためにタグに対して各記事、質問とユーザーがわかれば良い。△小文字と大文字は区別しない。△tagsテーブルにuser_idがあるとどんな人がタグを作るか、入力するかの分析につながりそうだがRDBではいらない
        
        // トランザクションの追加＝＝＝＝＝＝＝＝＝＝
        DB::transaction(function() use($article){
            // ⬇︎△送られてきたarticle_idを取得するとともにinsertする＝＝> 結合するarticleテーブルを作成  
            // [sharing knowledge]insertGetId()とは？何ができる？＝＞インサートするとともに、そのデータのID(ここではarticle_id)を返してくれる。
            $article_id = Article::insertGetId([
                'title' => $article['title'],
                'content' => $article['content'],
                'user_id' => Auth::id()
            ]);
            // ⬇︎同じタグが存在しないように、既存タグがぞんざいするかtrue or falseでの判定を返す = タグが入力されているかチェック
            $tag_exists = Tag::where(
                'name', '=', $article['create_tag'])
                ->exists();

            // ⬇︎「新しいタグが入力されており、既存のタグがない」という条件でDBにインサートする
            if( !empty($article['create_tag']) || $article['create_tag']==="0" &&  !$tag_exists){
                $tag_id = Tag::insertGetId( ['name' => $article['create_tag']] );
                // 🟡 □マイグレーション作成＆記述する
                ArticleTag::insert([
                    'article_id' => $article_id,
                    'tag_id' => $tag_id
                ]);
            }
        });

        // ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
    
        // [needs modify?] リダイレクト先は詳細画面じゃなくていいか？
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
