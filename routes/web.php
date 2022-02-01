<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TranslationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [MainController::class, 'home'])->name('home');
    Route::get('/about-us', [MainController::class, 'aboutUs'])->name('aboutUs');
    
    //products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{url}', [ProductController::class, 'single'])->name('products.single');
    Route::post('/products/ajax-get', [ProductController::class, 'ajaxGet'])->name('products.ajaxGet');
    Route::post('/products/download-instructions', [ProductController::class, 'downloadInstructions'])->name('products.downloadInstructions');

    //news 
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/{url}', [NewsController::class, 'single'])->name('news.single');
    Route::post('/news/ajax-get', [NewsController::class, 'ajaxGet'])->name('news.ajaxGet');

    Route::post('/search', [MainController::class, 'search'])->name('search');
    Route::post('/switch-locale', [MainController::class, 'switchLocale'])->name('switchLocale');
});


Route::group(['middleware' => 'auth'], function () {
    //products
    Route::get('/dashboard', [ProductController::class, 'dashboardIndex'])->name('dashboard.index');
    Route::get('/dashboard/products/create', [ProductController::class, 'dashboardCreate'])->name('dashboard.products.create');
    Route::get('/dashboard/products/{id}', [ProductController::class, 'dashboardSingle'])->name('dashboard.products.single');

    Route::post('/products/update', [ProductController::class, 'update'])->name('products.update');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::post('/products/remove', [ProductController::class, 'remove'])->name('products.remove');
    Route::post('/products/remove-multiple', [ProductController::class, 'removeMultiple'])->name('products.remove.multiple');

    //news
    Route::get('/dashboard/news', [NewsController::class, 'dashboardIndex'])->name('dashboard.news.index');
    Route::get('/dashboard/news/create', [NewsController::class, 'dashboardCreate'])->name('dashboard.news.create');
    Route::get('/dashboard/news/{id}', [NewsController::class, 'dashboardSingle'])->name('dashboard.news.single');

    Route::post('/news/update', [NewsController::class, 'update'])->name('news.update');
    Route::post('/news/store', [NewsController::class, 'store'])->name('news.store');
    Route::post('/news/remove', [NewsController::class, 'remove'])->name('news.remove');
    Route::post('/news/remove-multiple', [NewsController::class, 'removeMultiple'])->name('news.remove.multiple');

    //options
    Route::get('/dashboard/options', [OptionController::class, 'dashboardIndex'])->name('dashboard.options.index');
    Route::get('/dashboard/options/{id}', [OptionController::class, 'dashboardSingle'])->name('dashboard.options.single');

    Route::post('/options/update', [OptionController::class, 'update'])->name('options.update');

    //translations
    Route::get('/dashboard/translations', [TranslationController::class, 'dashboardIndex'])->name('dashboard.translations.index');
    Route::get('/dashboard/translations/{name}', [TranslationController::class, 'dashboardSingle'])->name('dashboard.translations.single');

    Route::post('/translations/update', [TranslationController::class, 'update'])->name('translations.update');
});

require_once __DIR__.'/auth.php';
