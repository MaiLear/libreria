<?php

use App\Http\Controllers\Views\AuthorController;
use App\Http\Controllers\Views\BookController;
use App\Http\Controllers\Views\LendController;
use App\Http\Controllers\Views\SaleController;
use App\Http\Controllers\Views\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [BookController::class, 'index'])->name('book.index');
Route::get('/users', [UserController::class,'index'])->name('user.index');
Route::get('/lends', [LendController::class,'index'])->name('lend.index');
Route::get('/sales', [SaleController::class,'index'])->name('sale.index');
Route::get('/authors', [AuthorController::class,'index'])->name('author.index');

