<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegistrationController;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;
// use Spatie\YamlFrontMatter\YamlFrontMatter;


Route::get( '/' , [PostController::class, 'index'])->name('home');
Route::get( 'posts/{post:slug}' , [PostController::class, 'show']);

Route::get( 'register' , [RegistrationController::class, 'create']);
Route::post( 'register' , [RegistrationController::class, 'store']);
