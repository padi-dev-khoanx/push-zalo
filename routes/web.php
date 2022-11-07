<?php

use App\Http\Controllers\ContentController;
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
        Route::get('/preview', [UploadController::class, 'uploadIndex'])->name('upload.preview.get');
        Route::post('/preview', [UploadController::class, 'preview'])->name('upload.preview');
        Route::post('/send-message', [UploadController::class, 'send'])->name('upload.send');
    });

    Route::prefix('history')->group(function () {
        Route::get('/', [ContentController::class, 'index'])->name('history.index');
        Route::get('/get', [ContentController::class, 'get'])->name('history.get');
    });
});
