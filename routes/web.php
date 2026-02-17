<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\rescontrol;

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
    return view('welcome');
});

Route::get('/home', [rescontrol::class, 'show']);
Route::get('/view/{id}', [rescontrol::class, 'view'])->name('view.resister');
Route::post('/add', [rescontrol::class, 'adduser'])->name('add.user');
Route::get('/update/{id}', [rescontrol::class, 'updateuser'])->name('update.resister');
Route::post('/update/{id}', [rescontrol::class, 'updateuserpost'])->name('update.user');
Route::get('/delete/{id}', [rescontrol::class,'deleteuser'])->name('delete.resister');
Route::get('/delete', [rescontrol::class,'deleteall'])->name('delete.all');
Route::post('/login', [rescontrol::class,'login'])->name('login');
Route::get('/logout', [rescontrol::class,'logout'])->name('logout');

Route::view('add', 'adduser');
Route::view('update', 'updateuser');
Route::view('loginuser', 'login');