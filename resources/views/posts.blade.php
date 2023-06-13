@include('template/header');
@php foreach ( $posts as $post ) :  @endphp
    <article>
        <h1>
            <a href="/posts/<?= $post->slug ?>">
                <?= $post->title ?>
            </a>
        </h1>
        <p>
            <a href="/categories/<?= $post->category->slug ?>"> <?= $post->category->name ?></a>
        </p> 
        <div>
            <?= $post->excerpt ?>
        </div>
        
    </article>

@php endforeach;     @endphp
   
@include('template/footer');