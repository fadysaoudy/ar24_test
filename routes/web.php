<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\UserDocumentController;
use App\Http\Controllers\UsersController;
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

Route::get('/', function () {
    return view('layouts.app');
})->name('app.home');
Route::prefix('user')->group(function () {
    //    user info
    Route::get('/', [UsersController::class, 'index'])->name('user.index');
    Route::post('/store', [UsersController::class, 'store'])->name('user.store');
    Route::get('/show', [UsersController::class, 'show'])->name('user.show');
    Route::get('/get', [UsersController::class, 'getUserByMail'])->name('user.get');

    Route::group(['prefix' => 'attachment'], function () {
        Route::post('/upload', [AttachmentController::class, 'store'])->name('attachment.store');
        Route::get('/', [AttachmentController::class, 'index'])->name('attachment.index');
    });

    Route::group(['prefix' => 'email'], function () {
        Route::post('/', [EmailController::class, 'store'])->name('email.store');
        Route::get('/', [EmailController::class, 'index'])->name('email.index');
        Route::get('/show', [EmailController::class, 'show'])->name('email.show');
        Route::get('/get', [EmailController::class, 'getEmailInfo'])->name('email.get');
    });


});
