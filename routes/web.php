<?php

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

// Sales Rep routes
Route::get('/', [App\Http\Controllers\SalesRepController::class, 'index'])->name('salesrep.list');
Route::get('/salesrep/create', [App\Http\Controllers\SalesRepController::class, 'create'])->name('salesrep.create');
Route::post('/salesrep/create', [App\Http\Controllers\SalesRepController::class, 'store']);
Route::get('/salesrep/edit/{id}', [App\Http\Controllers\SalesRepController::class, 'edit'])->name('salesrep.edit');
Route::put('/salesrep/edit/{id}', [App\Http\Controllers\SalesRepController::class, 'update'])->name('salesrep.update');
Route::get('/salesrep/delete/{id}', [App\Http\Controllers\SalesRepController::class, 'delete'])->name('salesrep.delete');

Route::get('/salesrep/create', [App\Http\Controllers\SalesRepController::class, 'create'])->name('salesrep.create');
Route::post('/salesrep/create', [App\Http\Controllers\SalesRepController::class, 'store']);

//Sales Rep Routes routes

Route::get('/routes/create', [App\Http\Controllers\RoutesController::class, 'create'])->name('routes.create');
Route::post('/routes/create', [App\Http\Controllers\RoutesController::class, 'store']);