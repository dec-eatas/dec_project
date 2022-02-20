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
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FavoriteController as Fav;



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
        Route::get('/show/{id}/{tentative?}',[Que::class,'show'])->name('Que.show');
        Route::post('/edit',[Que::class,'edit'])->name('Que.edit');
        Route::post('/store', [Que::class, 'store'])->name('Que.store');
        Route::get('/create', [Que::class, 'create'])->name('Que.create');
        Route::post('/update', [Que::class, 'update'])->name('Que.update');
        Route::post('/destroy', [Que::class, 'destroy'])->name('Que.destroy');
        
    });

    Route::prefix('/answer')->group( function () {
        Route::post('/confirm',[Ans::class,'confirm'])->name('Ans.confirm');
        Route::post('/store',[Ans::class,'store'])->name('Ans.store');
        Route::get('/edit',[Ans::class,'store'])->name('Ans.edit');
        Route::post('/update',[Ans::class,'update'])->name('Ans.update');
        Route::post('/destroy', [Ans::class, 'destroy'])->name('Ans.destroy');
        
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
// Route::prefix('/eataslab')->group( function () {

//     // ⬇︎ホーム画面の表示
//     // 🟡 [needs updating]ログインと登録から/eataslabに遷移するように
//     // 🟡 なぜここにアカウントコントローラを使用したのがあるの？
//     Route::get('/',[Acc::class,'index'])->name('eataslab');


//     // ⬇︎質問機能の画面へ遷移
//     Route::prefix('/question')->group( function () {
//         Route::get('/',[Que::class,'index']);
//         // 🟡[needs Reconciling perceptions] /detailがわからない。Q.レンレンこれは何用のメソッドとして用意した？？ => A.
//         Route::get('/detail',[Que::class,'detail']);
//     });


//     // ⬇︎記事機能の画面へ遷移
//     Route::prefix('/article')->group( function () {
//         Route::get('/',[Art::class,'index']);
//         Route::get('/detail',[Art::class,'detail']);

//     });


//     // ⬇︎アカウントの画面に遷移
//     Route::prefix('/account')->group( function () {
//         Route::get('/',[Acc::class,'index']);
//         Route::get('/detail',[Acc::class,'detail']);
//     });

// });

// Route::prefix('/question')->group( function () {

//     // ⬇︎質問一覧取得 (「/home」は 「/」だけにした方がわかりやすいかも)
//    Route::get('/', [QuestionsController::class, 'index'])->name('Quehome');
//    // ⬇︎質問詳細取得
//    Route::get('/show', [Questioncontroller::class,'show'])->name('Queshow');
//    // ⬇︎ 質問機能を作成 🟡一覧画面からになっているので、詳細画面からの形にする。
//    // [knowledge sharing] Route::get('/questionfunc', [App\Http\Controllers\QuestionsController::class, 'create'])->name('create');  //useで簡略化
//    Route::get('/create', [QuestionsController::class, 'create'])->name('Quecreate');
//    Route::post('/store', [QuestionsController::class, 'store'])->name('Questore');
//    // ⬇︎質問編集
//    Route::get('/edit/{id}', [QuestionsController::class, 'edit'])->name('Queedit');
//    // ⬇︎質問更新
//    Route::post('/update', [QuestionsController::class, 'update'])->name('Queupdate');
//    // ⬇︎質問削除
//    Route::post('/destroy', [QuestionsController::class, 'destroy'])->name('Quedestroy');
// });



// Route::prefix('/question')->group( function () {

//     // ⬇︎質問一覧取得 (「/home」は 「/」だけにした方がわかりやすいかも)
//     Route::get('/', [QuestionsController::class, 'index'])->name('Que.home');
    
//     // ⬇︎ 質問機能を作成 🟡一覧画面からになっているので、詳細画面からの形にする。
//     // [knowledge sharing] Route::get('/questionfunc', [App\Http\Controllers\QuestionsController::class, 'create'])->name('create');  //useで簡略化
//     Route::get('/create', [QuestionsController::class, 'create'])->name('Que.create');
//     Route::post('/store', [QuestionsController::class, 'store'])->name('Que.store');
    
//     // ⬇︎質問詳細取得
//     Route::get('/{id}', [QuestionsController::class,'show'])->name('Que.show');
//     // ⬇︎質問編集
//     Route::get('/{id}/edit', [QuestionsController::class, 'edit'])->name('Que.edit');
//     // ⬇︎質問更新
//     Route::post('/update', [QuestionsController::class, 'update'])->name('Que.update');
//     // ⬇︎質問削除
//     Route::post('/destroy', [QuestionsController::class, 'destroy'])->name('Que.destroy');


//     // ⬇︎answerの作成
//     // Route::prefix('/{id}')->group( function () {
//         // Route::resource('/answers', [AnswersController::class, ['only' => ['store']]);
//         // Route::get('/{id}', [AnswersController::class, 'index'])->name('Ans.index');
//         Route::post('/answer/store', [Ans::class, 'store'])->name('Ans.store');
//         // Route::get('/{id}/edit', [AnswersController::class, 'edit'])->name('Ans.edit');
//         // Route::post('/update', [AnswersController::class, 'update'])->name('Ans.update');
//         // Route::post('/destroy', [AnswersController::class, 'destroy'])->name('Ans.destroy');
//     // });
// });


// // ⬇︎質問編集
// Route::get('/show', [Questionscontroller::class,'show'])->name('Queshow');

// ゆきさんへ 今は画面上にあるメニューバーのTopicsを押すと、下の/topicsのルーティンググループを呼び出すようにしたけど、中身は上のをコピペしたから質問一覧が表示されるようになってるから、記事一覧になるようにこれから機能を作成して行って！
Route::prefix('/article')->group( function () {

    // ⬇︎記事一覧取得 (「/home」は 「/」だけにした方がわかりやすいかも)
    Route::get('/', [ArticlesController::class, 'index'])->name('Art.home');
    

    // ⬇︎ 記事機能を作成 🟡一覧画面からになっているので、詳細画面からの形にする。
    // [knowledge sharing] Route::get('/questionfunc', [App\Http\Controllers\QuestionsController::class, 'create'])->name('create');  //useで簡略化
    Route::get('/create', [ArticlesController::class, 'create'])->name('Art.create');
    Route::post('/store', [ArticlesController::class, 'store'])->name('Art.store');
    //詳細showページに飛ぶ
    Route::get('/show/{id}', [ArticlesController::class, 'show'])->name('Art.show');
    Route::post('/show', [ArticlesController::class, 'edit'])->name('Art.show');
    // // ⬇︎記事編集
    //Route::get('/edit/{id}', [ArticlesController::class, 'edit'])->name('Art.edit');
    // // ⬇︎記事更新
    Route::post('/update', [ArticlesController::class, 'update'])->name('Art.update');
    // ⬇︎記事削除
    Route::post('/destroy', [ArticlesController::class, 'destroy'])->name('Art.destroy');
    //⬇︎「いいね」の保存と削除
    Route::post('article/favorites/{article}', [FavoriteController::class, 'store'])->name('favorites');
    Route::post('article/unfavorites/{article}', [FavoriteController::class, 'destroy'])->name('un.favorites');

});