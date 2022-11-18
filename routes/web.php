<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('blog', [BlogController::class, 'index'])
    ->name('blog.index');

Route::group(['middleware' => 'auth'], function(){
    Route::get('blog/create', [BlogController::class, 'create'])
        ->name('blog.create'); 
        
    Route::post('blog', [BlogController::class, 'store'])
        ->name('blog.store'); 

    Route::get('blog/{blog:slug}/edit', [BlogController::class, 'edit'])
            ->name('blog.edit'); 

    Route::put('blog/{blog}', [BlogController::class, 'update'])
        ->name('blog.update'); 
});

Route::get('blog/{blog:slug}', [BlogController::class, 'show'])
    ->name('blog.show');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
