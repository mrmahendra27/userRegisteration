<?php

use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MainController;
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

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('loginform');
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('registerform');

Route::group(['middleware' => 'XssSanitize'], function () {
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [MainController::class, 'home'])->name('home');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'is_admin'], function () {
        Route::resource('users', ManageUserController::class);
        Route::delete('destroy/{id}', [ManageUserController::class, 'destroy'])->name('users.destroy');
        Route::delete('forcedestroy/{id}', [ManageUserController::class, 'forceDestroy'])->name('users.forcedestroy');
        Route::post('restore/{id}', [ManageUserController::class, 'restore'])->name('users.restore');
        Route::post('duplicate/remove', [ManageUserController::class, 'removeDuplicates'])->name('users.removeDuplicates');
    });
});
