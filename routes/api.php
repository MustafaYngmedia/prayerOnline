<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\API\CommentController;


Route::post('/registerLogin',[UserController::class,'registerLogin']);
Route::get('/categories',[UserController::class,'getAllCategories']);
Route::get('/admin-post',[AdminPostController::class,'allPost']);

Route::middleware('auth:api')->group(function(){
    Route::post('/user',[UserController::class,'updateUserInfo']);
    Route::get('/user',[UserController::class,'getUserInfo']);
    Route::post('/user/logout',[UserController::class,'logoutUser']);
    Route::get('/user/activity',[UserController::class,'userActivity']);
    Route::get('/user/post',[PostController::class,'userPosts']);


    Route::get('/post',[PostController::class,'allPost']);
    Route::post('/post',[PostController::class,'newPost']);
    Route::post('/post/like',[PostController::class,'likePost']);
    Route::post('/post/comment/like',[CommentController::class,'commentLike']);
    Route::post('/post/sub-comment/like',[CommentController::class,'subCommentLike']);

    Route::post('/post/{id}',[PostController::class,'newPost']);
    Route::get('/post/{id}',[PostController::class,'getPost']);

    Route::get('/post/comment/{id}',[CommentController::class,'getPostComment']);
    Route::get('/post/sub-comment/{id}',[CommentController::class,'getPostSubComment']);


    
    Route::post('sub-comment',[CommentController::class,'newSubComment']);
    Route::post('sub-comment/{id}',[CommentController::class,'newSubComment']);


    Route::post('comment',[CommentController::class,'newParentComment']);
    Route::post('comment/{id}',[CommentController::class,'newParentComment']);


});