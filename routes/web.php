<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MessageController;



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

Route::get('/', [PostController::class, 'index'])->name('index');
Route::resource('posts', PostController::class);

Route::get('like/{postId}', [LikeController::class, 'like'])->name('like');
Route::get('user/{name}', [UserController::class, 'profile'])->name('profile');

Auth::routes();

Route::get('/profile', [HomeController::class, 'index'])->name('profile.index');
Route::get('/profile/edit', [HomeController::class, 'edit'])->name('editProfile');
Route::put('/profile/update', [HomeController::class, 'update'])->name('profile.update');

//Route::get('/admin', [AdminController::class, 'index'])->name('admin.home');
//Route::post('/admin/make-admin', [AdminController::class, 'makeAdmin'])->name('admin.make-admin');

// Routes pour la page FAQ
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
Route::middleware('auth')->group(function () {
    Route::get('/faq/create', [FaqController::class, 'create'])->name('faq.create');
    Route::post('/faq', [FaqController::class, 'store'])->name('faq.store');
    Route::delete('/faq/{faq}', [FaqController::class, 'destroy'])->name('faq.destroy');
    // Routes supplémentaires pour l'édition et la suppression des FAQs
});

Route::get('/faq/{faq}/edit', [FaqController::class, 'edit'])->name('faq.edit');
Route::put('/faq/{faq}', [FaqController::class, 'update'])->name('faq.update');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users', [UserController::class, 'allUsers'])->name('users.all');
Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::put('/admin/promote/{id}', [UserController::class, 'promote'])->name('admin.promote');
Route::put('/admin/depromote/{id}', [UserController::class, 'depromote'])->name('admin.depromote');


Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');


// Route pour soumettre le formulaire de contact
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

// Route pour afficher la page de message (accessible uniquement aux admins)


Route::get('/message/{id}', [MessageController::class, 'show'])->name('message.show');


Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::get('/message', [MessageController::class, 'index'])->name('message');
// Chri