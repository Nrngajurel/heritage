@extends('layouts.frontend-new')

@push('styles')
    <style>
        .hero-background {
            background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.9)),
                url('https://heritagepageant.com/wp-content/uploads/2024/05/Picture1.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
            overflow: hidden;
        }

        .hero-background::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at center, rgba(255, 215, 0, 0.15) 0%, transparent 70%);
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 0.5;
            }

            50% {
                opacity: 1;
            }
        }

        .back-button {
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 215, 0, 0.2);
            transition: all 0.3s ease;
        }

        .back-button:hover {
            border-color: rgba(255, 215, 0, 0.5);
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.2);
            transform: translateY(-2px);
        }

        .crown-sparkle {
            position: relative;
        }

        .crown-sparkle::before,
        .crown-sparkle::after {
            content: '✨';
            position: absolute;
            font-size: 1.5rem;
            animation: sparkle 2s ease-in-out infinite;
        }

        .crown-sparkle::before {
            left: -20px;
            top: -10px;
            animation-delay: 0.5s;
        }

        .crown-sparkle::after {
            right: -20px;
            top: -10px;
        }

        @keyframes sparkle {

            0%,
            100% {
                opacity: 0;
                transform: scale(0.8);
            }

            50% {
                opacity: 1;
                transform: scale(1.1);
            }
        }

        .pageant-card {
            @apply relative overflow-hidden rounded-xl bg-black/30 backdrop-blur-sm border border-gold/20;
            box-shadow: 0 8px 32px rgba(218, 165, 32, 0.1);
        }

        .pageant-heading {
            background: linear-gradient(135deg, #FFD700, #FFA500);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 2px 10px rgba(255, 215, 0, 0.2);
        }

        .animate-glow {
            animation: glow 2s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from {
                box-shadow: 0 0 10px rgba(255, 215, 0, 0.2),
                    0 0 20px rgba(255, 215, 0, 0.1);
            }

            to {
                box-shadow: 0 0 20px rgba(255, 215, 0, 0.3),
                    0 0 30px rgba(255, 215, 0, 0.2);
            }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .contestant-banner {
            height: 90vh;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.9));
        }

        .gallery-item {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
        }

        .gallery-item:hover {
            transform: scale(1.03);
            border-color: #FFD700;
            box-shadow: 0 8px 32px rgba(218, 165, 32, 0.3);
        }

        .gold-gradient {
            background: linear-gradient(135deg, #FFD700, #FFA500);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .crown-bg {
            background: radial-gradient(circle at center, rgba(255, 215, 0, 0.15) 0%, transparent 70%);
        }

        .glass-card {
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 215, 0, 0.1);
        }

        .stats-item {
            position: relative;
            overflow: hidden;
        }

        .stats-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 215, 0, 0.1), transparent);
            transition: 0.5s;
        }

        .stats-item:hover::before {
            left: 100%;
        }

        .shimmer {
            position: relative;
            overflow: hidden;
        }

        .shimmer::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(to bottom right,
                    rgba(255, 215, 0, 0) 0%,
                    rgba(255, 215, 0, 0.1) 50%,
                    rgba(255, 215, 0, 0) 100%);
            transform: rotate(30deg);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            from {
                transform: rotate(30deg) translateX(-100%);
            }

            to {
                transform: rotate(30deg) translateX(100%);
            }
        }
    </style>
@endpush

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900" x-data="{ activeImage: '{{ $candidate->image_url }}', voting: voting() }"
        x-init="voting.votes = {{ json_encode([$candidate->id => $candidate->votes]) }}">
        <!-- Hero Section with Background -->
        <div class="hero-background relative min-h-[50vh] w-full overflow-hidden"
            style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.9)), url('{{ $candidate->image_url }}') center/cover no-repeat;">
            <!-- Decorative Overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-black/50 via-transparent to-black/50"></div>

            <!-- Back Button -->
            <div class="fixed left-4 top-20 z-20">
                <a href="{{ route('vote.index') }}"
                    class="hover:text-gold group flex items-center gap-2 rounded-full bg-black/20 px-4 py-2 text-sm text-white/70 backdrop-blur-sm transition-all duration-300 hover:bg-black/40">
                    <svg class="h-4 w-4 transition-transform duration-300 group-hover:-translate-x-1" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span>Back</span>
                </a>
            </div>

            <!-- Main Content Container -->
            <div class="relative z-10 flex min-h-[50vh] items-center justify-center px-4">
                <div class="mx-auto max-w-4xl text-center">
                    <!-- Crown and Title -->
                    <div class="mb-6">
                        <div class="crown-sparkle relative mb-4 inline-block">
                            <span class="animate-float text-5xl sm:text-6xl">👑</span>
                        </div>
                        <h2 class="text-gold/90 font-serif text-xl font-light tracking-wider">Miss Heritage International
                            2025</h2>
                    </div>

                    <!-- Contestant Name and Country -->
                    <div class="relative">
                        <h1 class="gold-gradient mb-4 font-serif text-4xl font-bold sm:text-5xl md:text-6xl"
                            style="text-shadow: 0 2px 20px rgba(255, 215, 0, 0.3);">
                            {{ $candidate->name }}
                        </h1>
                        <div class="flex items-center justify-center gap-4">
                            <div
                                class="border-gold/20 inline-flex items-center gap-3 rounded-full border bg-black/50 px-4 py-1.5">
                                <img src="https://flagcdn.com/w40/{{ strtolower($candidate->country_code) }}.png"
                                    alt="{{ $candidate->country }} flag" class="h-5 w-7 rounded shadow">
                                <span class="text-gold text-lg">{{ $candidate->country }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Decorative Elements -->
            <div class="pointer-events-none absolute inset-0 overflow-hidden">
                <div class="bg-gold/5 absolute left-1/4 top-1/4 h-32 w-32 rounded-full blur-3xl"></div>
                <div class="bg-gold/5 absolute right-1/4 top-3/4 h-32 w-32 rounded-full blur-3xl"></div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">

            <!-- Contestant Profile -->
            <div class="mx-auto grid max-w-6xl gap-8 lg:grid-cols-2">
                <!-- Left Side - Image Gallery -->
                <div
                    class="pageant-card hover:border-gold/40 group relative overflow-hidden rounded-2xl p-4 transition-all duration-300">
                    <!-- Country Flag Overlay -->
                    <div class="absolute -right-20 -top-20 z-10 h-40 w-40 rotate-45 overflow-hidden opacity-30">
                        <img src="https://flagcdn.com/w160/{{ strtolower($candidate->country_code) }}.png"
                            alt="{{ $candidate->country }} flag" class="h-full w-full object-cover">
                    </div>
                    <div class="aspect-[3/4] overflow-hidden rounded-xl">
                        <img :src="activeImage" alt="{{ $candidate->name }}"
                            class="h-full w-full object-cover transition-all duration-700 group-hover:scale-105 group-hover:brightness-110">
                    </div>

                    @if ($candidate->gallery)
                        <div class="mt-4 grid grid-cols-4 gap-3">
                            <p class="text-gold/80 col-span-4 mb-2 text-sm font-medium">Gallery</p>
                            @foreach (json_decode($candidate->gallery) as $image)
                                <button @click="activeImage = '{{ $image }}'"
                                    class="hover:border-gold aspect-square cursor-pointer overflow-hidden rounded-lg border-2 border-transparent transition-all duration-300 hover:brightness-110">
                                    <img src="{{ $image }}" alt="Gallery image of {{ $candidate->name }}"
                                        class="h-full w-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Right Side - Contestant Info -->
                <div class="relative space-y-8 px-8">
                    <!-- Basic Info -->
                    <div class="glass-card rounded-xl p-6 animate-glow">
                        <h1 class="pageant-heading text-3xl font-bold mb-2">{{ $candidate->name }}</h1>
                        <div class="flex items-center gap-3 mb-4">
                            <img src="https://flagcdn.com/w40/{{ strtolower($candidate->country_code) }}.png"
                                alt="{{ $candidate->country }} flag" class="h-6 rounded shadow-lg">
                            <span class="text-gold/90 font-semibold">{{ $candidate->country }}</span>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-gray-300">
                            <div class="stats-item p-3 glass-card rounded-lg">
                                <p class="text-sm text-gold/70">Age</p>
                                <p class="font-semibold">{{ $candidate->age }} Years</p>
                            </div>
                            <div class="stats-item p-3 glass-card rounded-lg">
                                <p class="text-sm text-gold/70">Height</p>
                                <p class="font-semibold">{{ $candidate->height }} cm</p>
                            </div>
                        </div>
                    </div>

                    <!-- Bio & Achievements -->
                    <div class="glass-card rounded-xl p-6">
                        <h2 class="text-xl font-semibold text-gold/90 mb-4">About {{ explode(' ', $candidate->name)[0] }}</h2>
                        <p class="text-gray-300 leading-relaxed mb-6">{{ $candidate->bio }}</p>
                        
                        @if($candidate->achievements)
                        <div class="space-y-3">
                            <h3 class="text-lg font-semibold text-gold/80">Achievements</h3>
                            <ul class="list-disc list-inside text-gray-300 space-y-2">
                                @foreach(explode('\n', $candidate->achievements) as $achievement)
                                    <li class="shimmer">{{ $achievement }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>

                    <!-- Additional Details -->
                    <div class="glass-card rounded-xl p-6">
                        <h2 class="text-xl font-semibold text-gold/90 mb-4">Additional Information</h2>
                        <div class="grid grid-cols-2 gap-4">
                            @if($candidate->occupation)
                            <div class="col-span-2">
                                <p class="text-sm text-gold/70">Occupation</p>
                                <p class="text-gray-300">{{ $candidate->occupation }}</p>
                            </div>
                            @endif
                            @if($candidate->education)
                            <div class="col-span-2">
                                <p class="text-sm text-gold/70">Education</p>
                                <p class="text-gray-300">{{ $candidate->education }}</p>
                            </div>
                            @endif
                            @if($candidate->languages)
                            <div class="col-span-2">
                                <p class="text-sm text-gold/70">Languages</p>
                                <p class="text-gray-300">{{ $candidate->languages }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Social Media Links -->
                    @if($candidate->social_media)
                    <div class="flex justify-center gap-4 py-4">
                        @foreach(json_decode($candidate->social_media, true) as $platform => $link)
                            <a href="{{ $link }}" target="_blank" rel="noopener noreferrer"
                               class="text-gold hover:text-gold/80 transition-colors duration-300">
                                <i class="fab fa-{{ strtolower($platform) }} text-2xl"></i>
                            </a>
                        @endforeach
                    </div>
                    @endif

                    <!-- Voting Section -->
                    <div class="glass-card rounded-xl p-6 text-center">
                        <h2 class="text-xl font-semibold text-gold/90 mb-4">Support {{ explode(' ', $candidate->name)[0] }}</h2>
                        <p class="text-gray-300 mb-4">Cast your vote to help {{ explode(' ', $candidate->name)[0] }} win!</p>
                        <div class="flex justify-center">
                            <button @click="voting.vote({{ $candidate->id }})" 
                                    class="back-button px-8 py-3 rounded-full text-gold hover:text-white transition-all duration-300"
                                    :disabled="voting.hasVoted({{ $candidate->id }})">
                                <span x-text="voting.hasVoted({{ $candidate->id }}) ? 'Voted!' : 'Vote Now'"></span>
                            </button>
                        </div>
                        <p class="text-sm text-gold/70 mt-4">
                            <span x-text="voting.votes[{{ $candidate->id }}] || 0"></span> votes received
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
