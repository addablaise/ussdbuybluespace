<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhoneNumberController;
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

Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('/logs', [AuthController::class, 'logs'])->name('logs');

    Route::get('/', [HomeController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::controller(PhoneNumberController::class)->group(function () {
        Route::get('/phone',  'index');
        Route::get('/phone/add',  'create')->name('phone.add');
        Route::post('/phone/store',  'store')->name('phone.store');
        Route::get('/phone/{id}/edit',  'edit')->name('phone.edit');
        Route::patch('/phone/{id}',  'update')->name('phone.update');
        Route::get('/phone/{id}/delete',  'destroy')->name('phone.delete');
    });
});