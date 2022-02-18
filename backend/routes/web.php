<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionsController; // 使う先のコントローラファイルまでuseする。 とりあえずは福冨さんもわかりやすいようこっちを採用したままにするね
use App\Http\Controllers\QuestionsController as Que;
// 🟥[error update]レンレンへ as 使うときは上のパス指定の省略が使えなくなってしまうので、他の人にコーディング任せたものは残しておいてね。
//  group question のルーティングが動作しなくなって
//  Target class [QuestionsController] does not exist. ってエラー吐かれます。
//  短い期間での開発だと細かい修正は後の方がいいから、長くなって嫌かもでけど残しておいてね。🟡消えた部分のcommitを見れたりする拡張機能ないかな？それがあればコミットメッセージちゃんと書いてもらえてば後々の修正は楽かも？
use App\Http\Controllers\AccountController as Acc;

// 
use App\Http\Controllers\AlticlesController; // 使う先のコントローラファイルまでuseする。 とりあえずは福冨さんもわかりやすいようこっちを採用したままにするね



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


Route::get('/', function () {
    return view('welcome');
});

// ⬇︎laravelUIのデフォルト
//[needs updateing]現状はクッキーを消さないとログインレジスターボタンがでない。
// コントローラが修正加わってたのでまずはデフォルトに戻した方がいいかも？？🟡現状を整理してレンレンと相談してから決める
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('logout', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// ⬇︎ホーム画面からのルーティンググループ
// 🟡 これってレイアウトの共通化ができてる？？navバーからかく機能グループへ飛ぶようになってるが、他の画面（/topics）からtobukotohadekiruka?
Route::prefix('/eataslab')->group( function () {

    // ⬇︎ホーム画面の表示
    // 🟡 [needs updating]ログインと登録から/eataslabに遷移するように
    // 🟡 なぜここにアカウントコントローラを使用したのがあるの？
    Route::get('/',[Acc::class,'index'])->name('eataslab');


    // ⬇︎質問機能の画面へ遷移
    Route::prefix('/question')->group( function () {
        Route::get('/',[Que::class,'index']);
        // 🟡[needs Reconciling perceptions] /detailがわからない。Q.レンレンこれは何用のメソッドとして用意した？？ => A.
        Route::get('/detail',[Que::class,'detail']);
    });


    // ⬇︎記事機能の画面へ遷移
    Route::prefix('/topics')->group( function () {
        Route::get('/',[TopicsController::class,'index']);
    });


    // ⬇︎アカウントの画面に遷移
    Route::prefix('/account')->group( function () {
        Route::get('/',[Acc::class,'index']);
        Route::get('/detail',[Acc::class,'detail']);
    });

});



Route::prefix('/question')->group( function () {

    // ⬇︎質問一覧取得 (「/home」は 「/」だけにした方がgetする時わかりやすいかも)
    Route::get('/', [QuestionsController::class, 'index'])->name('Quehome');
    // ⬇︎質問詳細取得
    Route::get('/show', [Questionscontroller::class,'show'])->name('Queshow');

    // ⬇︎ 質問機能を作成 🟡一覧画面からになっているので、詳細画面からの形にする。
    // [knowledge sharing] Route::get('/questionfunc', [App\Http\Controllers\QuestionsController::class, 'create'])->name('create');  //useで簡略化
    Route::get('/create', [QuestionsController::class, 'create'])->name('Quecreate');
    Route::post('/store', [QuestionsController::class, 'store'])->name('Questore');

    // ⬇︎質問編集
    Route::get('/edit/{id}', [QuestionsController::class, 'edit'])->name('Queedit');
    // ⬇︎質問更新
    Route::post('/update', [QuestionsController::class, 'update'])->name('Queupdate');
    // ⬇︎質問削除
    Route::post('/destroy', [QuestionsController::class, 'destroy'])->name('Quedestroy');

});











