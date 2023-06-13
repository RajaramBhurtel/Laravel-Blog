<?php

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;
// use Spatie\YamlFrontMatter\YamlFrontMatter;


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

Route::get( '/' , function () {

    return view( 'posts', [ 'posts' =>  Post::with('category')->get() ] );

});

Route::get( 'posts/{post:slug}' , function ( Post $post ) {
    //find a post by its slug and pass it to the view called "post"

    return view( 'post', [ 'post' => $post ] );
 
});
// })->whereAlpha( 'post' ); To use helper methods such as whereAlpha, whereAlphaNumeric etc;

Route::get( 'categories/{category:slug}' , function ( Category $category ) {
    //find a post by its slug and pass it to the view called "post"

    return view( 'posts', [ 'posts' => $category->posts ] );
 
});
Route::get( 'users/{user}' , function ( User $user ) {
    //find a post by its slug and pass it to the view called "post"

    return view( 'posts', [ 'posts' => $user->posts ] );
 
});