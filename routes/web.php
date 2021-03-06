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
use App\Http\Controllers\AdminPostController;

Auth::routes();
//Route::get('/',[LoginController::class,'login']);
Route::get('/', function () {

if(Auth::check()){
return redirect('/home');
}else{
return redirect('/login	');
}
//dd(Auth::check());
//if(Auth::check()){return Redirect::to('home');}
    //redirect('/login');
// view('welcome');
});
Route::group(['middleware' => 'auth'], function () {
   Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('posts',[App\Http\Controllers\HomeController::class,'postAll'])->name('posts');
Route::get('posts/delete/{id}',[App\Http\Controllers\HomeController::class,'deletePost'])->name('post.delete');
//    Route::get('/users/add',[App\Http\Controllers\HomeController::class, 'editUser'])->name('users.add');
   Route::post('/users/store',[App\Http\Controllers\HomeController::class, 'storeUser'])->name('users.store');
Route::get('users/delete/{id}',[App\Http\Controllers\HomeController::class,'deleteUser'])->name('user.delete');  
 // Route::get('/users/{id}',[App\Http\Controllers\HomeController::class, 'editUser'])->name('users.edit');
    Route::get('/users/list',[App\Http\Controllers\HomeController::class, 'listUsers'])->name('users.list');
    Route::get('/admin/add',[App\Http\Controllers\HomeController::class, 'editAdmin'])->name('admin.add');
    Route::post('/admin/store',[App\Http\Controllers\HomeController::class, 'storeAdmin'])->name('admin.store');
    Route::get('/admin/list',[App\Http\Controllers\HomeController::class, 'listAdminUsers'])->name('admin.list');
    Route::get('/admin/{id}',[App\Http\Controllers\HomeController::class, 'editAdmin'])->name('admin.edit');

    
    Route::get('/admin-post/add',[AdminPostController::class, 'editPost'])->name('admin-post.add');
    Route::post('/admin-post/store',[AdminPostController::class, 'storePost'])->name('admin-post.store');
    Route::get('/admin-post/list',[AdminPostController::class, 'listPosts'])->name('admin-post.list');
    Route::get('/admin-post/delete/{id}',[AdminPostController::class, 'deletePosts'])->name('admin-post.delete');
Route::get('/admin-post/{id}',[AdminPostController::class, 'editPost'])->name('admin-post.edit');
    
});

Route::get('/Privacy',function(){
return view('privacy');
});
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
