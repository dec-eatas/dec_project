<?php

use App\Http\Controllers\AccountController as Acc;
use App\Http\Controllers\RegisterController as Reg;
use App\Http\Controllers\QuestionsController as Que; //使う先のコントローラファイルまでuseする
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// ↓追加

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

Route::get('/eata', function () {
    return view('account.index');
});

Route::prefix('/eataslab')->group( function () {
    
    Route::get('/',[Acc::class,'index'])->name('eataslab');

    Route::prefix('/account')->group( function () {

        Route::get('/',[Acc::class,'index'])->name('account');
        Route::get('/detail',[Acc::class,'detail'])->name('account_detail');
        
    });
    
    Route::prefix('/question')->group( function () {

        Route::get('/',[Que::class,'index'])->name('question');
        Route::get('/detail',[Que::class,'detail'])->name('question_detail');
        
    });

});

Route::prefix('/authent')->group( function () {

    Route::get('/register',[Reg::class,'create'])
        ->middleware('guest')
        ->name('register');
    
    Route::post('/register',[Reg::class,'store'])
    ->middleware('guest');

    Route::get('/login',[Reg::class,'index'])
    ->middleware('guest')
    ->name('login');

    Route::post('/login',[Reg::class,'authenticate'])
    ->middleware('guest');
    
});

// Auth::routes();

// ⬇︎質問機能を作成
// Route::get('/questionfunc', [Que::class, 'create'])->name('create');  //useで簡略化
Route::get('/questionfunc', [Que::class, 'create'])->name('create');
Route::post('/questionfunc', [Que::class, 'store'])->name('store');

// ⬇︎質問一覧取得
Route::get('/home', [QuestionsController::class, 'index'])->name('home');
Route::get('logout', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ⬇︎質問編集
Route::get('/edit/{id}', [QuestionsController::class, 'edit'])->name('edit');






