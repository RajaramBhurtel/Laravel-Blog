@include('template/header')
   
    @include('posts.header')
    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if ($posts->count())
           @include('template.post-grid',  $posts)
           {{ $posts->links()}}
        @else
            <p class="text-center">No Posts found. Please come back later.</p>
        @endif
    </main>
    
        
@include('template/footer')