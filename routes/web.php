<?php

use App\Http\Controllers\AuthController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/clear-cache', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');

    die('clear!!!');
});

Route::group([
    'as' => 'auth.'
], function (Router $router) {
    $router->get('/', [AuthController::class, 'Login'])->name('login');
    $router->post('check/login', [AuthController::class, 'checkLogin'])->name('check-login');
    // end login

    $router->get('register', [AuthController::class, 'Register'])->name('register');
    $router->post('handle/register', [AuthController::class, 'handleRegister'])->name('handle-register');
    // end register

    Route::get('login/google', [AuthController::class, 'loginGoogle'])->name('login-google');
    Route::get('auth/google/callback', [AuthController::class, 'loginGoogleCallback'])->name('login-google-callback');
    // end login google
});
