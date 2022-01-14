<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;

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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [MainController::class, 'home'])->name('home');
    Route::get('/about-us', [MainController::class, 'about_us'])->name('about_us');
    
    //products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{url}', [ProductController::class, 'single'])->name('products.single');

    Route::post('/products/ajax_get', [ProductController::class, 'ajax_get'])->name('products.ajax_get');
    Route::post('/products/download_instructions', [ProductController::class, 'download_instructions'])->name('products.download_instructions');

    //news 
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/{url}', [NewsController::class, 'single'])->name('news.single');

    Route::post('/news/ajax_get', [NewsController::class, 'ajax_get'])->name('news.ajax_get');


    Route::post('/search', [MainController::class, 'search'])->name('search');
    Route::post('/switch_locale', [MainController::class, 'switch_locale'])->name('switch_locale');
});

require_once __DIR__.'/auth.php';
