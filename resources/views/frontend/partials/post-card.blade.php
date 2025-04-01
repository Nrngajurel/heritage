<a href="{{ $post->external_link ? $post->external_link : route('blog.show', $post) }}" {{ $post->external_link ? 'target="_blank"' : '' }} class="block">
    <div class="overflow-hidden rounded-lg bg-gray-800">
        <img src="{{ asset('storage/' . $post->image) }}" class="h-48 w-full object-cover" alt="{{ $post->title }}">
        <div class="p-4">
            <h3 class="mb-2 text-lg font-medium text-white">{{ $post->title }}</h3>
            @if($post->external_link)
                <p class="text-sm text-gray-400">{{ $post->source }}</p>
            @else
                <p class="mb-4 text-gray-400">{{ $post->title }}</p>
                <span class="text-white hover:underline">Read More →</span>
            @endif
        </div>
    </div>
</a>
