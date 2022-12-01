<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth'])->group(function(){
    Route::get('/home',[CategoryController::class, 'index'])->name('home');
    Route::resources([
        'categories'=> CategoryController::class,
        'books'=> BookController::class,
        'orders'=> OrderController::class,
        'wishlists'=> WishlistController::class
    ]);

    Route::post('books/filter', [BookController::class, 'filterBooks'])->name('books.filter');
    Route::post('books/find', [BookController::class, 'findBooks'])->name('books.find');

});

