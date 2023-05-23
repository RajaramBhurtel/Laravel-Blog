<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

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
        if( ! file_exists( $path = resource_path( "posts/{$slug}.html" ) ) ){
            throw new ModelNotFoundException();
        }

        return cache()->remember( "posts.{$slug}", 1200, fn()=> file_get_contents( $path ));
    }

    public static function findAll(){
        $files = File::allFiles(  resource_path( "posts/" ));

        return array_map( fn( $file )=> $file->getContents(), $files );
    }
}
