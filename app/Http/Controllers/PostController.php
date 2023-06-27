<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index() {

        return view( 'posts.index', [ 
            'posts' =>  Post::latest()->filter(
                request(['search','category', 'author'])
            )->paginate(6)->withQueryString()
        ]);

    }
    public function show( Post $post) {
        return view( 'posts.show', [ 'post' => $post ] );
    }

    public function create( ) {
        return view( 'admin.posts.create' );
    }

    public function store( ) {
        $attributes = $this->validatePost();
        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        Post::create($attributes);
        
        return redirect('/')->with( 'success', 'New post created successfully' );
    }

    public function view( ) {
        return view( 'admin.posts.index', [
            'posts' => Post::paginate(50)
        ] );
    }

    public function edit(Post $post) {
        return view('admin.posts.edit', [
            'post' => $post
        ]);
    }

    public function update(Post $post) {
        $attributes = $this->validatePost($post);

        if ($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($attributes);

        return back()->with('success', 'Post has been updated' );
    }

    public function delete(Post $post){
        $post->delete();

        return back()->with('success', 'Post Deleted!');
    }

    protected function validatePost(?Post $post = null): array {
        $post ??= new Post();

        return request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'published_at' => 'required'
        ]);
    }

}
