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

use App\Http\Controllers\Auth\LoginController;
Auth::routes();
Route::get('/',[LoginController::class,'login']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    // Route::get('/users/add',[App\Http\Controllers\HomeController::class, 'editUser'])->name('users.add');
    // Route::post('/users/store',[App\Http\Controllers\HomeController::class, 'storeUser'])->name('users.store');
    // Route::get('/users/{id}',[App\Http\Controllers\HomeController::class, 'editUser'])->name('users.edit');


    Route::get('/users/list',[App\Http\Controllers\HomeController::class, 'listUsers'])->name('users.list');
    Route::get('/admin/add',[App\Http\Controllers\HomeController::class, 'editUser'])->name('admin.add');
    Route::post('/admin/store',[App\Http\Controllers\HomeController::class, 'storeAdmin'])->name('admin.store');
    Route::get('/admin/list',[App\Http\Controllers\HomeController::class, 'listAdminUsers'])->name('admin.list');
    Route::get('/admin/{id}',[App\Http\Controllers\HomeController::class, 'editAdmin'])->name('admin.edit');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
