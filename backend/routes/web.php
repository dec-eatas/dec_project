<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionsController; //使う先のコントローラファイルまでuseする
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
Route::get('/account',[App\Http\Controllers\AccountController::class,'index']);

Route::get('/', function () {
    return view('welcome');
});


// Route::get('register', function () {
//     return view('welcome');
// });

// Route::get('login', function () {
//     return view('welcome');
// });

Route::get('/eata', function () {
    return view('account.index');
});

Route::prefix('/eataslab')->group( function () {
    Route::get('/',[App\Http\Controllers\AccountController::class,'index']);


    Route::prefix('/account')->group( function () {

        Route::get('/',[App\Http\Controllers\AccountController::class,'index']);
        Route::get('/detail',[App\Http\Controllers\AccountController::class,'detail']);
        
    });
    
    Route::prefix('/question')->group( function () {

        Route::get('/',[App\Http\Controllers\QuestionsController::class,'index']);
        Route::get('/detail',[App\Http\Controllers\QuestionsController::class,'detail']);
        
    });


    Route::get('/', function () {
        return view('account.index');
    });


});

// Route::prefix('/authent')->group( function () {

//     Route::get('/register',[App\Http\Controllers\RegisterController::class,'create'])
//         ->middleware('guest')
//         ->name('register');
    
//     Route::post('/register',[App\Http\Controllers\RegisterController::class,'store'])
//     ->middleware('guest');

//     Route::get('/login',[App\Http\Controllers\RegisterController::class,'index'])
//     ->middleware('guest')
//     ->name('login');

//     Route::post('/login',[App\Http\Controllers\RegisterController::class,'authenticate'])
//     ->middleware('guest');
    
// });

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






