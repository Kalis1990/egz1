<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController as A;
use App\Http\Controllers\BookController as B;
use App\Http\Controllers\HomeController as H;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [H::class, 'homeList'])->name('home')->middleware('gate:home');
Route::put('/rate/{book}', [H::class, 'rate'])->name('rate')->middleware('gate:user');

Route::prefix('author')->name('a_')->group(function () {
    Route::get('/', [A::class, 'index'])->name('index')->middleware('gate:user');
    Route::get('/create', [A::class, 'create'])->name('create')->middleware('gate:admin');
    Route::post('/create', [A::class, 'store'])->name('store')->middleware('gate:admin');
    Route::get('/show/{author}', [A::class, 'show'])->name('show')->middleware('gate:user');
    Route::delete('/delete/{author}', [A::class, 'destroy'])->name('delete')->middleware('gate:admin');
    Route::get('/edit/{author}', [A::class, 'edit'])->name('edit')->middleware('gate:admin');
    Route::put('/edit/{author}', [A::class, 'update'])->name('update')->middleware('gate:admin');
    Route::delete('/delete-books/{author}', [A::class, 'destroyAll'])->name('delete_books')->middleware('gate:admin');
});

Route::prefix('book')->name('b_')->group(function () {
    Route::get('/', [B::class, 'index'])->name('index')->middleware('gate:user');
    Route::get('/create', [B::class, 'create'])->name('create')->middleware('gate:admin');
    Route::post('/create', [B::class, 'store'])->name('store')->middleware('gate:admin');
    Route::get('/show/{book}', [B::class, 'show'])->name('show')->middleware('gate:user');
    Route::delete('/delete/{book}', [B::class, 'destroy'])->name('delete')->middleware('gate:admin');
    Route::get('/edit/{book}', [B::class, 'edit'])->name('edit')->middleware('gate:admin');
    Route::put('/edit/{book}', [B::class, 'update'])->name('update')->middleware('gate:admin');
});