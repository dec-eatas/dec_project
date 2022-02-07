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
    return view('table_station.index');
});


Route::get('/register',[App\Http\Controllers\RegisterController::class,'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register',[App\Http\Controllers\RegisterController::class,'store'])
->middleware('guest');

Route::prefix('/TableStation')->group( function () {

    Route::get('/',[App\Http\Controllers\TableStation::class,'index']);
    Route::get('/detail',[App\Http\Controllers\TableStation::class,'detail']);
    Route::post('/detail',[App\Http\Controllers\TableStation::class,'detail'])
        ->middleware([App\Http\Middleware\TableMiddleware::class]);
    Route::get('/record',[App\Http\Controllers\TableStation::class,'record']);
    Route::post('/record',[App\Http\Controllers\TableStation::class,'record'])
        ->middleware([App\Http\Middleware\TableMiddleware::class]);
    Route::get('/delete',[App\Http\Controllers\TableStation::class,'detail'])
        ->middleware([App\Http\Middleware\TableMiddleware::class]);

});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


