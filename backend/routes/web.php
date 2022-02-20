<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionsController as Que;
// [error update]レンレンへ as 使うときは上のパス指定の省略が使えなくなってしまうので、他の人にコーディング任せたものは残しておいてね。
//  group question のルーティングが動作しなくなって
//  Target class [QuestionsController] does not exist. ってエラー吐かれます。
//  短い期間での開発だと細かい修正は後の方がいいから、長くなって嫌かもでけど残しておいてね。🟡消えた部分のcommitを見れたりする拡張機能ないかな？それがあればコミットメッセージちゃんと書いてもらえてば後々の修正は楽かも？
use App\Http\Controllers\AccountController as Acc;
use App\Http\Controllers\ArticlesController as Art; // 使う先のコントローラファイルまでuseする。 とりあえずは福冨さんもわかりやすいようこっちを採用したままにするね
use App\Http\Controllers\AnswersController as Ans;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// ↓追加
Route::get('/account',[Acc::class,'index']);

Route::get('/', function () {
    return view('welcome');
});


// Route::get('register', function () {
//     return view('welcome');
// });

// Route::get('login', function () {
//     return view('welcome');
// });

Route::prefix('/eataslab')->group( function () {
    
    Route::get('/',[Acc::class,'index'])->name('eataslab');

    Route::prefix('/account')->group( function () {

        Route::get('/',[Acc::class,'index'])->name('account');
        Route::get('/detail',[Acc::class,'detail'])->name('account_detail');
        
    });
    
    Route::prefix('/question')->group( function () {

        Route::get('/',[Que::class,'index'])->name('Question');
        Route::get('/detail/{id}',[Que::class,'detail'])->name('que.detail');
        Route::post('/edit',[Que::class,'edit'])->name('que.edit');
        Route::get('/show', [Que::class,'show'])->name('Queshow');
        Route::post('/store', [Que::class, 'store'])->name('Questore');
        Route::get('/create', [Que::class, 'create'])->name('Quecreate');
        Route::post('/edit', [Que::class,'edit'])->name('que.edit');
        Route::post('/update', [Que::class, 'update'])->name('Queupdate');
        Route::post('/destroy', [Que::class, 'destroy'])->name('Quedestroy');
        
    });

    Route::prefix('/answer')->group( function () {

        Route::post('/store',[Ans::class,'store'])->name('ans.store');
        Route::get('/edit',[Ans::class,'store'])->name('ans.edit');
        Route::post('/edit',[Ans::class,'update'])->name('ans.update');
        Route::post('/destroy', [Ans::class, 'destroy'])->name('ans.destroy');
        
    });

    Route::prefix('/article')->group( function () {

        Route::get('/',[Art::class,'index']);
        Route::get('/detail',[Art::class,'detail']);

    });

});

// ⬇︎laravelUIのデフォルト
//[needs updateing]現状はクッキーを消さないとログインレジスターボタンがでない。
// コントローラが修正加わってたのでまずはデフォルトに戻した方がいいかも？？🟡現状を整理してレンレンと相談してから決める
// Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('logout', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// ⬇︎ホーム画面からのルーティンググループ
// 🟡 これってレイアウトの共通化ができてる？？navバーからかく機能グループへ飛ぶようになってるが、他の画面（/topics）からtobukotohadekiruka?

// // ⬇︎質問編集
// Route::get('/show', [Questionscontroller::class,'show'])->name('Queshow');

// ゆきさんへ 今は画面上にあるメニューバーのTopicsを押すと、下の/topicsのルーティンググループを呼び出すようにしたけど、中身は上のをコピペしたから質問一覧が表示されるようになってるから、記事一覧になるようにこれから機能を作成して行って！
Route::prefix('/article')->group( function () {

    // ⬇︎記事一覧取得 (「/home」は 「/」だけにした方がわかりやすいかも)
    Route::get('/', [ArticlesController::class, 'index'])->name('Arthome');
    // // ⬇︎記事詳細取得
    // Route::get('/show', [ArticlesController::class,'show'])->name('Artshow');


// Route::prefix('/question')->group( function () {

//     // ⬇︎質問一覧取得 (「/home」は 「/」だけにした方がgetする時わかりやすいかも)
//     Route::get('/', [QuestionsController::class, 'index'])->name('Quehome');
//     // ⬇︎質問詳細取得
//     Route::get('/show', [Questionscontroller::class,'show'])->name('Queshow');


    // ⬇︎ 記事機能を作成 🟡一覧画面からになっているので、詳細画面からの形にする。
    // [knowledge sharing] Route::get('/questionfunc', [App\Http\Controllers\QuestionsController::class, 'create'])->name('create');  //useで簡略化
    Route::get('/create', [ArticlesController::class, 'create'])->name('Artcreate');
    Route::post('/store', [ArticlesController::class, 'store'])->name('Artstore');

    // // ⬇︎記事編集
    Route::get('/edit/{id}', [ArticlesController::class, 'edit'])->name('Artedit');
    // // ⬇︎記事更新
    Route::post('/update', [ArticlesController::class, 'update'])->name('Artupdate');
    // ⬇︎記事削除
    Route::post('/destroy', [ArticlesController::class, 'destroy'])->name('Artdestroy');

});






