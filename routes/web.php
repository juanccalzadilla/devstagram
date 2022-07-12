<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\HomeController;

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




// Configuracion de usuario 
Route::get('/configuracion',[PerfilController::class,'index'])->name('perfil.index')->middleware('auth');
Route::post('/configuracion',[PerfilController::class,'store'])->name('perfil.store')->middleware('auth');


Route::get('/register',[RegisterController::class,'index'])->name('register');
Route::post('/register',[RegisterController::class,'store']);

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);
Route::post('/logout',[LogoutController::class,'store'])->name('logout');

Route::get('/{user:username}',[PostController::class,'index'])->name('posts.index');

// Aplicar un middleware a la siguiente ruta

Route::get('/posts/create',[PostController::class,'create'])->name('posts.create')->middleware('auth');
Route::post('/posts',[PostController::class,'store'])->name('posts.store');

// Post singular para verlo
Route::get('/{user:username}/posts/{post}',[PostController::class,'show'])->name('posts.show');
// Comentario 
Route::post('/{user:username}/posts/{post}',[ComentarioController::class,'store'])->name('comentarios.store');

// Me gusta 
Route::post('/posts/{post}/likes',[LikeController::class,'store'])->name('likes.store');

Route::delete('/posts/{post}/likes',[LikeController::class,'destroy'])->name('likes.destroy');

Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');

// Imagenes
Route::post('/imagenes',[ImagenController::class,'store'])->name('imagenes.store');


// followers
Route::post('/{user:username}/follow',[FollowerController::class,'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow',[FollowerController::class,'destroy'])->name('users.unfollow');


// HOME 

Route::get('/',HomeController::class)->name('home')->middleware('auth');




