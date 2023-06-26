@include('template.header')
<section class="py-8 max-w-md mx-auto">
    <h1 class="text-lg font-bold mb-4">{{ $heading }}</h1>
    
    <div class="border border-gray-200 p-6 rounded-xl ">
        {{ $slot }}
    </div>
</section>

@include('template.footer')