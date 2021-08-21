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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/games/{game:code}', \App\Actions\GameActive\GetGameBoard::class)->name('game');
Route::get('/games/{game:code}/players/{player:code}', \App\Actions\GameStart\SetSessionPlayer::class)->name('return-to-game');

Route::view('about','about');
Route::view('admin','admin.login');
Route::view('admin/dashboard','admin.dashboard')->middleware(['auth']);
Route::post('admin/login', \App\Actions\Admin\SendAdminLoginLink::class);
Route::get('admin/login', \App\Actions\Admin\AdminLogin::class)->name('admin-authenticate');
