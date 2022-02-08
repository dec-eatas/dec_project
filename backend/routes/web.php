<?php

use Illuminate\Support\Facades\Route;
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
Route::get('/account',[App\Http\Controllers\AccountController::class,'index']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/eata', function () {
    return view('account.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');