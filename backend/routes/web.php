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

<<<<<<< HEAD

=======
>>>>>>> origin
Route::get('register', function () {
    return view('welcome');
});

Route::get('login', function () {
    return view('welcome');
});

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

});

Route::prefix('/authent')->group( function () {

    Route::get('/register',[App\Http\Controllers\RegisterController::class,'create'])
        ->middleware('guest')
        ->name('register');
    
    Route::post('/register',[App\Http\Controllers\RegisterController::class,'store'])
    ->middleware('guest');

    Route::get('/login',[App\Http\Controllers\RegisterController::class,'index'])
    ->middleware('guest')
    ->name('login');

    Route::post('/login',[App\Http\Controllers\RegisterController::class,'authenticate'])
    ->middleware('guest');
    
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('logout', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// // Route::get('/eata', function () {
// //     return view('account.index');
// // });
// Route::get('/eata', function () {
//     return view('layout.master');
// });

// Route::get('/question', function () {
//     return view('questions.create');
// });
// // Route::group(['middleware' => 'auth'], function() {
// //     Route::resource('topics', 'QuestionsController', ['only' => ['index']]);
// // });


// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('logout', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
