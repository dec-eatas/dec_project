<?php

namespace App\Http\Controllers;

use App\Services\ListService;
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
        // dd($articles);入力
        //ここでデータを取得
        // $articles = ListService::shape_questions($articles);
        $search_route ='Art.search';
        // return view　article　のindex
        return view('article.index', compact('articles','search_route'));
        // dd($articles);



        // ⬇︎tagの表示処理追加🟡コンポーネントに合わせてできたら修正する。
        $tags = Tag::whereNull('deleted_at')->orderBy('id','DESC')
            ->get();
        // dd($tags);


        return view('article.index', compact('articles', 'tags'));

    }
    public function search_title(Request $request)
    {   //urlパラメーターとしてのkeywordが取れる
        $keyword = $request->input('keyword');
        
        //取ってきたデータを一時保存
        $articles = Article::where('title', 'LIKE', '%'.$keyword.'%')
            ->orderBy('updated_at', 'DESC')
            ->get();
        
        // $articles = ListService::shape_questions($questions_before);
        $search_route ='Art.search';
        return view('article.index', compact('articles','search_route'));
    }
    



    public function create()
    {

        // ⬇︎tagの表示処理追加🟡コンポーネントに合わせてできたら修正する。
        $tags = Tag::whereNull('deleted_at')->orderBy('id','DESC')
        ->get();
        // dd($tags);
    

        return view('article.create', compact('tags'));
    }



    public function store(Request $request)  // 記事をDBに追加(DB)
    {
        $article = $request->all();
        // dd($article);
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

            // dd($article_id,$tag_exists);

            // ⬇︎「新しいタグが入力されており、既存のタグがない」という条件でDBにインサートする
            if( !empty($article['create_tag']) || $article['create_tag']==="0" &&  !$tag_exists){
                $tag_id = Tag::insertGetId( [
                    'user_id' => Auth::id(),
                    'name' => $article['create_tag']] );
                // 🟡 □マイグレーション作成＆記述する
                ArticleTag::insert([
                    'article_id' => $article_id,
                    'tag_id' => $tag_id
                ]);
            }


            // ⬇︎index()で表示されたタグをPOSTで受け取る。nameはtags[]と配列で渡ってくる
            if(!empty($article['tags'][0])){

                foreach($article['tags'] as $tag){
                    ArticleTag::insert([
                        'article_id' => $article_id,
                        'tag_id' => $tag
                    ]);
                }
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


        // ⬇︎tagの表示処理追加🟡コンポーネントに合わせてできたら修正する。
        $tags = Tag::whereNull('deleted_at')->orderBy('id','DESC')
            ->get();
        dd($tags);


        return view('article.show', compact('article'));
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
