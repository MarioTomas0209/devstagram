<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
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

Route::get('/home', HomeController::class)->name('home');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout'); // SIRVE PARA CERRA SESION


// RUTAS PARA EL PERFIL
Route::get('/edit-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/edit-perfil', [PerfilController::class, 'store'])->name('perfil.store');

/**Para que aparezca una variable en la url debemos poner una varaible {user} y utilizarlo en el
 * controlador PostController. Para que laravel pueda saber que valor va utilizar en la bd debemos
 * pasar el nombre de la tabla. Video 87
 */
/** Para poder agregar imagenes hay que seguir la convencion de laravel en la ruta  /posts/create es un ejemplo de como es 
 * debe de ir. Video 89
*/
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/{post}', [PostController::class , 'destroy'])->name('posts.destroy');

// Ruta para subir imagenes
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

// COMENTARIOS
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');

// LIKES A LAS FOTOS
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');


/** SIGUIENDO USUARIOS */
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');