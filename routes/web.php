<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UploadController;
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
Route::middleware('web')->group(function () {
    Route::get('/login', 'Auth\LoginController@showLoginAdminForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login');
});

Route::middleware('web', 'auth')->group(function () {
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('upload')->group(function () {
        Route::get('/', [UploadController::class, 'index'])->name('upload.index');
        Route::post('/upload-file', [UploadController::class, 'upload'])->name('upload.upload');
        Route::delete('/delete/{id}', [UploadController::class, 'destroy'])->name('upload.delete');
        Route::get('/edit/{id}', [UploadController::class, 'edit'])->name('upload.edit');
        Route::post('/update/{id}', [UploadController::class, 'update'])->name('upload.update');
        Route::get('/show/{id}', [UploadController::class, 'show'])->name('upload.show');
    });
});