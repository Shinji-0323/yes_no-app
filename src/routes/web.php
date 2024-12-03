<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\YesNoController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/start', [YesNoController::class, 'start'])->name('start');
Route::get('/gender', [YesNoController::class, 'gender'])->name('gender');
Route::post('/age', [YesNoController::class, 'age'])->name('age');
Route::post('/diagnosis', [YesNoController::class, 'diagnosis'])->name('diagnosis');
Route::get('/', [YesNoController::class, 'index'])->name('index');

Route::get('/products/normal', [ProductController::class, 'normal'])->name('normal');
Route::get('/products/oily', [ProductController::class, 'oily'])->name('oily');
Route::get('/products/dry', [ProductController::class, 'dry'])->name('dry');
Route::get('/products/combo', [ProductController::class, 'combo'])->name('combo');

Route::get('/admin/results', [AdminController::class, 'results'])->name('admin.results');
Route::get('/admin/results/csv', [AdminController::class, 'exportCsv'])->name('admin.results.csv');