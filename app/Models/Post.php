<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post{
    public $title;
    public $excerpt;
    public $date;
    public $slug;
    public $body;

    public function __construct( $title, $excerpt, $date, $slug, $body )
    {
        $this->title    = $title;
        $this->excerpt  = $excerpt;
        $this->date     = $date;
        $this->slug     = $slug;
        $this->body     = $body;

    }
    public static function find( $slug ){
        // find the first post with the slug it matches
        return static::findAll()->firstWhere( 'slug', $slug );
     }
    public static function findOrFail( $slug ){
       // find the first post with the slug it matches
       $post = static::find( $slug );

       if  (! $post){
        throw new ModelNotFoundException();
       }
      
       return $post;
    }

    public static function findAll(){
        return cache()->rememberForever( 'posts.findAll', function(){
            return collect( File::allFiles(  resource_path( "posts/" )) )
            ->map( fn( $file )=> YamlFrontMatter::parseFile( $file ) )
            ->map( fn( $doc )=> new Post(
                $doc->title,
                $doc->excerpt,
                $doc->date,
                $doc->slug,
                $doc->body()
            ))
            ->sortByDesc( 'date' );
        });
    }
}


// cache('post.findAll') - to view cache
// cache()->forget('posts.all') - to delete cache