<x-app-layout>
    <div class="py-8 wrapper">
        <h1 class="text-4xl font-bold text-gray-600"> {{ $post->name }} </h1>

        <div class="mb-2 text-lg text-gray-500">
            {{ $post->extract }}
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            {{-- Contenido principal --}}
            <div class="md:col-span-2">
                <figure>
                    <img class="object-cover object-center w-full h-80" src="{{ Storage::url($post->image->url) }}"
                        alt="{{ $post->name }}">
                </figure>

                <div class="mt-4 text-base text-gray-500">
                    {{ $post->body }}
                </div>
            </div>

            {{-- Contenido Relacionado --}}
            <aside>
                <h1 class="mb-4 text-2xl font-bold text-gray-600">
                    Más en {{ $post->category->name }}
                </h1>
                <ul>
                    @foreach ($relatedPosts as $relatedPost)
                        <li class="mb-4">
                            <a class="flex" href="{{ route('posts.show', $relatedPost) }}">

                                @if ($relatedPost->image)
                                    <img class="object-cover object-center h-20 w-36"
                                        src="{{ Storage::url($relatedPost->image->url) }}"
                                        alt="{{ $relatedPost->name }}">
                                @else
                                    <img class="object-cover object-center h-20 w-36"
                                        src="https://cdn.pixabay.com/photo/2017/04/16/18/08/test-tube-2235388_960_720.png"
                                        alt="{{ $relatedPost->name }}">
                                @endif

                                <span class="ml-2 text-gray-600">{{ $relatedPost->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </aside>

        </div>
    </div>
</x-app-layout>
