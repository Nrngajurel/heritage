@props(['contestant'])

<div class="bg-white p-6 dark:bg-gray-800" x-data="{ contestantIndex: null }" x-init="contestantIndex = contestants.findIndex(c => c.id === contestant.id) + 1">
    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
        <!-- Left Column - Image and Social Share -->
        <div>
            <div class="relative mb-4 aspect-[3/4] overflow-hidden rounded-lg">
                <img src="{{ Storage::url($contestant->image_url) }}" alt="{{ $contestant->name }}" class="h-full w-full object-cover">
            </div>
            
            <!-- Vote Button -->
            <div class="mb-4">
                <button type="button"
                    class="vote-button group relative inline-flex w-full items-center justify-center overflow-hidden rounded-lg bg-gradient-to-br from-purple-600 to-blue-500 p-0.5 text-sm font-medium text-gray-900 hover:text-white focus:outline-none focus:ring-4 focus:ring-blue-300 group-hover:from-purple-600 group-hover:to-blue-500 dark:text-white dark:focus:ring-blue-800"
                    x-on:click.prevent="vote(contestantIndex)">
                    <span class="relative flex w-full items-center justify-center gap-2 rounded-md bg-white px-5 py-2.5 transition-all duration-75 ease-in group-hover:bg-opacity-0 dark:bg-gray-900">
                        <span>Vote for {{ $contestant->name }}</span>
                        <span class="text-lg">👑</span>
                    </span>
                </button>
            </div>

            <!-- Social Share Buttons -->
            <div class="mt-4 flex justify-center space-x-4">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                    <i class="fab fa-facebook-f text-2xl"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text=Vote for {{ $contestant->name }}" target="_blank" class="text-blue-400 hover:text-blue-600">
                    <i class="fab fa-twitter text-2xl"></i>
                </a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}" target="_blank" class="text-blue-700 hover:text-blue-900">
                    <i class="fab fa-linkedin-in text-2xl"></i>
                </a>
            </div>
        </div>

        <!-- Right Column - Details -->
        <div>
            <h2 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $contestant->name }}</h2>
            <p class="mb-4 text-xl text-gray-600 dark:text-gray-300">{{ $contestant->title }}</p>
            
            <div class="mb-6">
                <h3 class="mb-2 text-lg font-semibold text-gray-800 dark:text-gray-200">About</h3>
                <p class="text-gray-600 dark:text-gray-400">{{ $contestant->bio }}</p>
            </div>

            <div class="mb-6">
                <h3 class="mb-2 text-lg font-semibold text-gray-800 dark:text-gray-200">Focus Area</h3>
                <p class="text-gray-600 dark:text-gray-400">{{ $contestant->focus_area }}</p>
            </div>

            <!-- Social Media Profiles -->
            @if($contestant->social_media)
            <div class="mb-6">
                <h3 class="mb-2 text-lg font-semibold text-gray-800 dark:text-gray-200">Connect With Me</h3>
                <div class="flex space-x-4">
                    @foreach(json_decode($contestant->social_media) as $platform => $url)
                        <a href="{{ $url }}" target="_blank" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                            <i class="fab fa-{{ strtolower($platform) }} text-2xl"></i>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Gallery Section -->
            @if(isset($contestant->gallery) && count($contestant->gallery) > 0)
            <div class="mb-6">
                <h3 class="mb-2 text-lg font-semibold text-gray-800 dark:text-gray-200">Gallery</h3>
                <div class="grid grid-cols-3 gap-2">
                    @foreach($contestant->gallery as $image)
                    <div class="aspect-square overflow-hidden rounded-lg">
                        <img src="{{ $image }}" alt="Gallery image" class="h-full w-full object-cover transition-transform duration-300 hover:scale-110">
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Quotes Section -->
            @if(isset($contestant->quotes) && $contestant->quotes)
            <div class="mb-6">
                <h3 class="mb-2 text-lg font-semibold text-gray-800 dark:text-gray-200">Inspiring Words</h3>
                <blockquote class="border-gold border-l-4 pl-4 italic text-gray-600 dark:text-gray-400">
                    "{{ $contestant->quotes }}"
                </blockquote>
            </div>
            @endif
        </div>
    </div>
</div>
