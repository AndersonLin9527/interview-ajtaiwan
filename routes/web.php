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

// 會員登入頁
Route::post('/loginPage', 'App\Http\Controllers\ControllerMembersAuth@loginPage')
  ->name('membersAuth.loginPage');

// 會員登入
Route::post('/login', 'App\Http\Controllers\ControllerMembersAuth@login')
  ->name('membersAuth.login');

// 會員登出
Route::get('/logout', 'App\Http\Controllers\ControllerMembersAuth@logout')
  ->name('membersAuth.logout');

// 會員註冊頁
Route::get('/registerPage', 'App\Http\Controllers\ControllerMembersAuth@registerPage')
  ->name('membersAuth.registerPage');

// middleware 阻擋未登入的 admins 進入後台
Route::middleware(['auth:members'])->group(function () {

  Route::get('/', function () {
    return view('global.index');
  })->name('global.index');

});
