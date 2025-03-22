@props(['contestant'])

<div class="bg-white dark:bg-gray-800 p-6" x-data="{ contestantIndex: null }" x-init="contestantIndex = contestants.findIndex(c => c.id === contestant.id) + 1">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Left Column - Image and Social Share -->
        <div>
            <div class="relative aspect-[3/4] overflow-hidden rounded-lg mb-4">
                <img src="{{ $contestant->image_url }}" alt="{{ $contestant->name }}" class="object-cover w-full h-full">
            </div>
            
            <!-- Vote Button -->
            <div class="mb-4">
                <button type="button"
                    class="vote-button w-full group relative inline-flex items-center justify-center overflow-hidden rounded-lg bg-gradient-to-br from-purple-600 to-blue-500 p-0.5 text-sm font-medium text-gray-900 hover:text-white focus:outline-none focus:ring-4 focus:ring-blue-300 group-hover:from-purple-600 group-hover:to-blue-500 dark:text-white dark:focus:ring-blue-800"
                    x-on:click.prevent="vote(contestantIndex)">
                    <span class="relative flex w-full items-center justify-center gap-2 rounded-md bg-white px-5 py-2.5 transition-all duration-75 ease-in group-hover:bg-opacity-0 dark:bg-gray-900">
                        <span>Vote for {{ $contestant->name }}</span>
                        <span class="text-lg">👑</span>
                    </span>
                </button>
            </div>

            <!-- Social Share Buttons -->
            <div class="flex justify-center space-x-4 mt-4">
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
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $contestant->name }}</h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 mb-4">{{ $contestant->title }}</p>
            
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">About</h3>
                <p class="text-gray-600 dark:text-gray-400">{{ $contestant->bio }}</p>
            </div>

            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">Focus Area</h3>
                <p class="text-gray-600 dark:text-gray-400">{{ $contestant->focus_area }}</p>
            </div>

            <!-- Social Media Profiles -->
            @if($contestant->social_media)
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">Connect With Me</h3>
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
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">Gallery</h3>
                <div class="grid grid-cols-3 gap-2">
                    @foreach($contestant->gallery as $image)
                    <div class="aspect-square overflow-hidden rounded-lg">
                        <img src="{{ $image }}" alt="Gallery image" class="object-cover w-full h-full hover:scale-110 transition-transform duration-300">
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Quotes Section -->
            @if(isset($contestant->quotes) && $contestant->quotes)
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">Inspiring Words</h3>
                <blockquote class="italic text-gray-600 dark:text-gray-400 border-l-4 border-gold pl-4">
                    "{{ $contestant->quotes }}"
                </blockquote>
            </div>
            @endif
        </div>
    </div>
</div>
