<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegistercontroller;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\SiswaController;
Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [LoginRegistercontroller::class, 'register'])->name('register');
    Route::post('/store', [LoginRegistercontroller::class, 'store'])->name('store'); 
    Route::get('/login', [LoginRegistercontroller::class, 'login'])->name('login'); 
    Route::post('/authenticate', [LoginRegistercontroller::class, 'authenticate'])->name('authenticate');
});

Route::middleware('auth','admin')->group(function (){
    Route::get('admin/dashboard', [AdminController::class,'index'])->name('admin/dashboard');
    Route::resource('/admin/siswa', SiswaController::class);
    Route::post('/logout', [LoginRegistercontroller::class,'logout'])->name('logout');
}); 