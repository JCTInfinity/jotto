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

Route::get('/games/{game:code}',\App\Actions\GetGameBoard::class)->name('game');
Route::get('/players/{player:code}',\App\Actions\SetSessionPlayer::class)->name('return-to-game');

Route::view('about','about');
Route::view('admin','admin.login');
Route::view('admin/dashboard','admin.dashboard')->middleware(['auth']);
Route::post('admin/login',\App\Actions\SendAdminLoginLink::class);
Route::get('admin/login',\App\Actions\AdminLogin::class)->name('admin-authenticate');
