<?php

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
    Route::get('/', [\Despawn\Http\Controllers\IndexController::class, '__invoke'])->name('home');

    require __DIR__ . '/auth.php';
    require __DIR__ . '/profile.php';
    require __DIR__ . '/forums.php';
    require __DIR__ . '/users.php';
    require __DIR__ . '/store.php';
    require __DIR__ . '/servers.php';
});
