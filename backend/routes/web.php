<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionsController as Que;
use App\Http\Controllers\AccountController as Acc;
use App\Http\Controllers\ArticlesController as Art; 
use App\Http\Controllers\AnswersController as Ans;
use App\Http\Controllers\FavoriteController as Fav;
use Illuminate\Support\Facades\Auth;

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
        Route::post('/edit', [Que::class,'edit'])->name('Que.edit');
        Route::post('/update', [Que::class, 'update'])->name('Que.update');
        Route::post('/destroy', [Que::class, 'destroy'])->name('Que.destroy');
        Route::post('/favorites/{question}', [Fav::class, 'que_store'])->name('que.favorites');
        Route::post('/un.favorites/{question}', [Fav::class, 'que_destroy'])->name('que.unfavorites');

    
        
    });

    Route::prefix('/answer')->group( function () {

        Route::post('/store',[Ans::class,'store'])->name('ans.store');
        Route::post('/back',[Ans::class,'back'])->name('Ans.back');
        Route::post('/store',[Ans::class,'store'])->name('Ans.store');
        Route::get('/edit',[Ans::class,'store'])->name('Ans.edit');
        Route::post('/update',[Ans::class,'update'])->name('Ans.update');
        Route::post('/destroy', [Ans::class, 'destroy'])->name('Ans.destroy');
        Route::post('/favorites/{answer}', [Fav::class, 'ans_store'])->name('ans.favorites');
        Route::post('/un.favorites/{answer}', [Fav::class, 'ans_destroy'])->name('ans.unfavorites');
        Route::post('/confirm',[Ans::class,'confirm'])->name('Ans.confirm');
        
    });

    Route::prefix('/article')->group( function () {
    

        Route::get('/', [Art::class, 'index'])->name('Art.home');
        Route::get('/create', [Art::class, 'create'])->name('Art.create');
        Route::post('/store', [Art::class, 'store'])->name('Art.store');
        Route::get('/show/{id}', [Art::class, 'show'])->name('Art.show');
        Route::post('/show', [Art::class, 'edit'])->name('Art.edit');
        Route::post('/update', [Art::class, 'update'])->name('Art.update');
        Route::post('/destroy', [Art::class, 'destroy'])->name('Art.destroy');
        Route::post('/favorites/{article}', [Fav::class, 'art_store'])->name('favorites');
        Route::post('/un.favorites/{article}', [Fav::class, 'art_destroy'])->name('un.favorites');

});


});


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('logout', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



