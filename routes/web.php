<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BongkarmuatController;
use App\Http\Controllers\KapalController;
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

//Authentication
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

//Barang
Route::get('/dashboard', [BarangController::class, 'index'])->name('barang.index')->middleware('auth');
Route::get('/barang/add', [BarangController::class, 'create'])->name('barang.create')->middleware('auth');
Route::get('/barang/edit/{id}', [BarangController::class, 'edit'])->name('barang.edit')->middleware('auth');
Route::post('/barang/update/{id}', [BarangController::class, 'update'])->name('barang.update');
Route::post('/barang/delete/{id}', [BarangController::class, 'delete'])->name('barang.delete');
Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/search', [BarangController::class, 'search'])->name('barang.search')->middleware('auth');
Route::get('/barang/restore/search', [BarangController::class, 'search_trash'])->name('barang.search_trash')->middleware('auth');
Route::get('/barang/recent', [BarangController::class, 'softindex'])->name('barang.softindex')->middleware('auth');
Route::post('/barang/delete/{id}', [BarangController::class, 'softdelete'])->name('barang.softdelete')->middleware('auth');
Route::get('/barang/restore/{id}', [BarangController::class, 'restore'])->name('barang.restore');
Route::post('/barang/restore/delete/{id}', [BarangController::class, 'delete'])->name('barang.delete');

//Kapal
Route::get('/kapal', [KapalController::class, 'index'])->name('kapal.index')->middleware('auth');
Route::get('kapal/add', [KapalController::class, 'create'])->name('kapal.create')->middleware('auth');
Route::get('kapal/edit/{id}', [KapalController::class, 'edit'])->name('kapal.edit')->middleware('auth');
Route::post('kapal/update/{id}', [KapalController::class, 'update'])->name('kapal.update');
Route::post('kapal/delete/{id}', [KapalController::class, 'delete'])->name('kapal.delete');
Route::post('kapalstore', [KapalController::class, 'store'])->name('kapal.store');
Route::get('/kapal/search', [KapalController::class, 'search'])->name('kapal.search')->middleware('auth');
Route::get('/kapal/restore/search', [KapalController::class, 'search_trash'])->name('kapal.search_trash')->middleware('auth');
Route::get('/kapal/recent', [KapalController::class, 'softindex'])->name('kapal.softindex')->middleware('auth');
Route::post('/kapal/delete/{id}', [KapalController::class, 'softdelete'])->name('kapal.softdelete')->middleware('auth');
Route::get('/kapal/restore/{id}', [KapalController::class, 'restore'])->name('kapal.restore');
Route::post('/kapal/restore/delete/{id}', [KapalController::class, 'delete'])->name('kapal.delete');

//Bongkar Muat
Route::get('/bongkar', [BongkarmuatController::class, 'index'])->name('bongkarmuat.index')->middleware('auth');
Route::get('/bongkar/search', [BongkarmuatController::class, 'search'])->name('bongkarmuat.search')->middleware('auth');
Route::get('/bongkar/restore/search', [BongkarmuatController::class, 'search_trash'])->name('bongkarmuat.search_trash')->middleware('auth');
Route::get('/bongkar/recent', [BongkarmuatController::class, 'softindex'])->name('bongkarmuat.softindex')->middleware('auth');
Route::get('/bongkar/add', [BongkarmuatController::class, 'create'])->name('bongkarmuat.create')->middleware('auth');
Route::get('/bongkar/edit/{id}', [BongkarmuatController::class, 'edit'])->name('bongkarmuat.edit')->middleware('auth');
Route::post('/bongkar/update/{id}', [BongkarmuatController::class, 'update'])->name('bongkarmuat.update');
Route::post('/bongkar/delete/{id}', [BongkarmuatController::class, 'softdelete'])->name('bongkarmuat.softdelete')->middleware('auth');
Route::post('/bongkar/store', [BongkarmuatController::class, 'store'])->name('bongkarmuat.store');
Route::get('/bongkar/restore/{id}', [BongkarmuatController::class, 'restore'])->name('bongkarmuat.restore');
Route::post('/bongkar/restore/delete/{id}', [BongkarmuatController::class, 'delete'])->name('bongkarmuat.delete');
