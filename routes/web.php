<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'landingpage']);
Route::get('/register', [App\Http\Controllers\HomeController::class, 'register']);
Route::post('/registeract', [App\Http\Controllers\HomeController::class, 'registerAct']);
Route::get('/authapp', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);
Route::post('/forgotpassw', [App\Http\Controllers\HomeController::class, 'forgotPassw']);
Route::group(['middleware' => ['auth', 'api']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/index.html', [App\Http\Controllers\HomeController::class, 'index'])->name('index.html');
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('profile', [UserController::class, 'profile']);
    });
});
Auth::routes();
