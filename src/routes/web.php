<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\YesNoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InterviewController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

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

Route::get('/', [YesNoController::class, 'index'])->name('index');
Route::get('/gender', [YesNoController::class, 'gender'])->name('gender');
Route::post('/age', [YesNoController::class, 'age'])->name('age');
Route::post('/diagnosis', [YesNoController::class, 'diagnosis'])->name('diagnosis');
Route::get('/results', [YesNoController::class, 'results'])->name('results');
Route::post('/result', [YesNoController::class, 'storeResult'])->name('result.store');

Route::get('/products/normal', [ProductController::class, 'normal'])->name('normal');
Route::get('/products/oily', [ProductController::class, 'oily'])->name('oily');
Route::get('/products/dry', [ProductController::class, 'dry'])->name('dry');
Route::get('/products/combo', [ProductController::class, 'combo'])->name('combo');

Route::get('/interview/start', [InterviewController::class, 'index'])->name('interview.start');
Route::get('/interview/name', [InterviewController::class, 'name'])->name('interview.name');
Route::get('/interview/age', [InterviewController::class, 'age'])->name('interview.age');
Route::post('/interview/index', [InterviewController::class, 'interview'])->name('interview');
Route::get('/interview/next', [InterviewController::class, 'nextCategory'])->name('interview.next.category');
Route::get('/interview/results', [InterviewController::class, 'results'])->name('interview.results');
Route::post('/interview/result', [InterviewController::class, 'storeResult'])->name('interview.result.store');

Route::group(['prefix' => 'admin', 'middleware' => ['guest:admin']], function () {
    Route::get('/register', function () {
        return view('admin.register');
    })->name('admin.register');
    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->middleware('guest:admin');
    Route::get('/login', function () {
        return view('admin.login');
    })->name('admin.login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest:admin');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin']], function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/results', [AdminController::class, 'results'])->name('admin.results');
    Route::get('/admin/results/csv', [AdminController::class, 'export'])->name('admin.results.csv');
    Route::get('/admin/interview_results', [AdminController::class, 'interview_results'])->name('admin.interview_results');
    Route::get('/admin/interview_results/csv', [AdminController::class, 'interview_export'])->name('admin.interview_results.csv');
});