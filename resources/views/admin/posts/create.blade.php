<x-setting heading="Create New Post">
    <form method="POST" action="/admin/posts" enctype="multipart/form-data">
        @csrf

        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                   for="title"
            >
                Title
            </label>

            <input class="border border-gray-200 rounded p-2 w-full"
                   type="text"
                   name="title"
                   id="title"
                   value="{{ old('title') }}"
                   required
            >

            @error('title')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                   for="slug"
            >
                Slug
            </label>

            <input class="border border-gray-200 rounded p-2 w-full"
                   type="text"
                   name="slug"
                   id="slug"
                   value="{{ old('slug') }}"
                   required
            >

            @error('slug')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>


        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                   for="excerpt"
            >
                Excerpt
            </label>

            <textarea class="border border-gray-200 rounded p-2 w-full"
                   name="excerpt"
                   id="excerpt"
                   required
            >{{ old('excerpt') }}</textarea>

            @error('excerpt')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                   for="thumbnail"
            >
                Thumbnail
            </label>

            <input class="border border-gray-200 rounded p-2 w-full"
                   type="file"
                   name="thumbnail"
                   id="thumbnail"
                   required
            >

            @error('thumbnail')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                   for="body"
            >
                Body
            </label>

            <textarea class="border border-gray-200 rounded p-2 w-full"
                   name="body"
                   id="body"
                   required
            >{{ old('body') }}</textarea>

            @error('body')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                   for="category_id"
            >
                Category
            </label>

            <select name="category_id" id="category_id">
                @foreach (\App\Models\Category::all() as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}
                    >{{ ucwords($category->name) }}</option>
                @endforeach
            </select>

            @error('category')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-6">
            <button type="submit"
                    class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
            >
            Publish
            </button>
        </div>
    </form>
</x-setting>