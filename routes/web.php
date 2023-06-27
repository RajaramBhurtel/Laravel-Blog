<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegistrationController;


// use Spatie\YamlFrontMatter\YamlFrontMatter;


Route::get( '/' , [PostController::class, 'index'])->name('home');
Route::get( 'posts/{post:slug}' , [PostController::class, 'show']);
Route::post( 'posts/{post:slug}/comments' , [CommentController::class, 'store']);

Route::get( 'register' , [RegistrationController::class, 'create'])->middleware('guest');
Route::post( 'register' , [RegistrationController::class, 'store'])->middleware('guest');

Route::get( 'login' , [SessionController::class, 'create'])->middleware('guest');
Route::post( 'login' , [SessionController::class, 'store'])->middleware('guest');
Route::post( 'logout' , [SessionController::class, 'destroy'])->middleware('auth');

Route::post('newsletter', NewsletterController::class);

Route::get('admin/posts/create', [PostController::class, 'create'])->middleware('admin');
Route::get('admin/posts', [PostController::class, 'view'])->middleware('admin');
Route::get('admin/posts/{post:id}/edit', [PostController::class, 'edit'])->middleware('admin');
Route::patch('admin/posts/{post:id}', [PostController::class, 'update'])->middleware('admin');
Route::post('admin/posts', [PostController::class, 'store'])->middleware('admin');