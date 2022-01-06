<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
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

    //search
    Route::get('/search', [MainController::class, 'store'])->name('search');
});

require_once __DIR__.'/auth.php';
