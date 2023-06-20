<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;
// use Spatie\YamlFrontMatter\YamlFrontMatter;


Route::get( '/' , [PostController::class, 'index'])->name('home');
Route::get( 'posts/{post:slug}' , [PostController::class, 'show']);

Route::get( 'register' , [RegistrationController::class, 'create'])->middleware('guest');
Route::post( 'register' , [RegistrationController::class, 'store'])->middleware('guest');
Route::post( 'logout' , [SessionController::class, 'destroy']);
