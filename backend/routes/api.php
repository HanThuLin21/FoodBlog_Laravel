<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\AdminController;

Route::post('/user/register', [AuthController::class, 'userRegister']);
Route::post('/user/login', [AuthController::class, 'userLogin']);
Route::post('/admin/register', [AuthController::class, 'adminRegister']);
Route::post('/admin/login', [AuthController::class, 'adminLogin']);
Route::get('/admin/stats', [AdminController::class, 'getStats']);

use App\Http\Controllers\UserController;
Route::get('/users', [UserController::class, 'index']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CommentController;

Route::apiResource('blogposts', BlogPostController::class);
Route::apiResource('restaurants', RestaurantController::class);
Route::apiResource('recipes', RecipeController::class);

Route::get('comments/{postId}', [CommentController::class, 'index']);
Route::post('comments', [CommentController::class, 'store']);
Route::delete('comments/{id}', [CommentController::class, 'destroy']);
