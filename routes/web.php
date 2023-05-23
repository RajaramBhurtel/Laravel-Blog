<?php

use App\Models\Post;
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

    $posts = collect( File::allFiles(  resource_path( "posts/" )) )
        ->map( fn( $file )=> YamlFrontMatter::parseFile( $file ) )
        ->map( fn( $doc )=> new Post(
            $doc->title,
            $doc->excerpt,
            $doc->date,
            $doc->slug,
            $doc->body()
        ));

    return view( 'posts', [ 'posts' => $posts ] );

 
});

Route::get( 'posts/{post}' , function ( $slug ) {


    //find a post by its slug and pass it to the view called "post"

    $post = Post::find( $slug );
    return view( 'post', [ 'post' => $post ] );

       
    // return view( 'post', ['post' => $post]);
 
})->where( 'post', '[A-z_/-]+' );
// })->whereAlpha( 'post' ); To use helper methods such as whereAlpha, whereAlphaNumeric etc;
