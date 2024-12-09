<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now crea te something great!
|
*/

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/search', [ProductController::class, 'search'])->name('search');
Route::post('/products/register', [ProductController::class, 'store'])->name('register');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('show');
Route::put('/products/{id}/update', [ProductController::class, 'update'])->name('update');
Route::delete('/products/{id}/delete', [ProductController::class, 'destroy'])->name('destroy');
