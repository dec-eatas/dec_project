<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionsController as Que; //使う先のコントローラファイルまでuseする
use App\Http\Controllers\AccountController as Acc;
// ↓追加

/*
|--------------------------------------------------------------------------
| Web Routes
|-----------------------------------------------{{ ---- }}-----------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// ↓追加

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/eataslab')->group( function () {
    
    Route::get('/',[Acc::class,'index']);

    Route::prefix('/account')->group( function () {

        Route::get('/',[Acc::class,'index']);
        Route::get('/detail',[Acc::class,'detail']);
        
    });
    
    Route::prefix('/question')->group( function () {

        Route::get('/',[Que::class,'index']);
        Route::get('/detail',[Que::class,'detail']);
        
    });

});

Auth::routes();
Route::get('logout', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::prefix('/question')->group( function () {

    // ⬇︎質問機能を作成 🟡一覧画面からになっているので、詳細画面からの形にする。
    // Route::get('/questionfunc', [App\Http\Controllers\QuestionsController::class, 'create'])->name('create');  //useで簡略化
    Route::get('/create', [QuestionsController::class, 'create'])->name('create');

    Route::post('/questionfunc', [QuestionsController::class, 'store'])->name('store');
    
    // ⬇︎質問一覧取得 (「/home」は 「/」だけにした方がわかりやすいかも)
    Route::get('/home', [QuestionsController::class, 'index'])->name('home');
    
    // ⬇︎質問編集
    Route::get('/edit/{id}', [QuestionsController::class, 'edit'])->name('edit');
    // ⬇︎質問更新
    Route::post('/update', [QuestionsController::class, 'update'])->name('update');
    // ⬇︎質問削除
    Route::post('/destroy', [QuestionsController::class, 'destroy'])->name('destroy');


});

// // グループ化前
// //⬇︎質問機能を作成
// // Route::get('/questionfunc', [Que::class, 'create'])->name('create');  //useで簡略化
// Route::get('/questionfunc', [Que::class, 'create'])->name('create');
// Route::post('/questionfunc', [Que::class, 'store'])->name('store');

// // ⬇︎質問一覧取得
// Route::get('/home', [Que::class, 'index'])->name('home');
// Route::get('logout', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// // ⬇︎質問編集
// Route::get('/edit/{id}', [Que::class, 'edit'])->name('edit');






