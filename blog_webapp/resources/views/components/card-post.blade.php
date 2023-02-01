@props(['post'])

<article class="mb-8 overflow-hidden bg-white rounded-lg shadow-lg">
    <img class="object-cover object-center w-full h-72" src="{{ Storage::url($post->image->url) }} "
        alt="">

    <div class="px-6 py-4">
        <h1><a href="{{ route('posts.show', $post)}}" class="mb-2 text-xl font-bold">{{ $post->name }}</a></h1>

        <div class="text-base text-gray-700">{{ $post->extract }}</div>

        <div class="pt-4 pb-2">
            @foreach ($post->tags as $tag)
                <a href="{{ route('posts.tag', $tag) }}" class="inline-block px-3 py-1 mr-2 text-sm text-gray-700 bg-gray-200 rounded-full"> {{ $tag->name }}</a>

            @endforeach
        </div>
    </div>

</article>
