@include('template/header');
<article>
    <h1>
        <?= $post->title ?>
    </h1> 
    <p>
        By <a href="/users/<?= $post->user->id ?>"><?= $post->user->name ?></a><a href="/categories/<?= $post->category->slug ?>"> <?= $post->category->name ?></a>
        </p>
    <div>
        <?= $post->body ?>
    </div>
</article>
<a href="/">Go Back</a>
@include('template/footer');