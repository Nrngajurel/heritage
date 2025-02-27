@extends('layouts.frontend-new')

@push('styles')
    <style>
        /* Luxury Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
            background: rgba(0, 0, 0, 0.2);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #FFD700, #FFA500);
            border-radius: 5px;
            border: 2px solid rgba(0, 0, 0, 0.2);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #FFA500, #FFD700);
        }

        /* Glamorous Text Effects */
        .luxury-text {
            background: linear-gradient(to right, #FFD700, #FFA500, #FFD700);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 3s linear infinite;
            background-size: 200% auto;
        }

        @keyframes shimmer {
            to {
                background-position: 200% center;
            }
        }

        .elegant-border {
            position: relative;
            border: 1px solid rgba(255, 215, 0, 0.3);
        }

        .elegant-border::before {
            content: '';
            position: absolute;
            inset: -2px;
            z-index: -1;
            background: linear-gradient(45deg, 
                transparent, rgba(255, 215, 0, 0.3), transparent,
                rgba(255, 215, 0, 0.3), transparent
            );
            background-size: 400% 400%;
            animation: borderGlow 8s linear infinite;
        }

        @keyframes borderGlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

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
            background:
                radial-gradient(circle at 20% 20%, rgba(255, 215, 0, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 215, 0, 0.15) 0%, transparent 50%),
                radial-gradient(circle at center, rgba(255, 215, 0, 0.1) 0%, transparent 70%);
            animation: pulse 4s ease-in-out infinite;
        }

        .hero-background::after {
            content: '';
            position: absolute;
            top: 0;
            left: -150%;
            width: 150%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 215, 0, 0.2), transparent);
            animation: shine 8s infinite;
        }

        @keyframes shine {
            0% { transform: translateX(0); }
            20%, 100% { transform: translateX(200%); }
        }

        @keyframes twinkle {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.3; transform: scale(0.8); }
        }

        .animate-twinkle {
            animation: twinkle 1.5s ease-in-out infinite;
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
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .pageant-card:hover {
            border-color: rgba(255, 215, 0, 0.4);
            box-shadow: 
                0 8px 32px rgba(218, 165, 32, 0.2),
                0 0 0 1px rgba(255, 215, 0, 0.1);
            transform: translateY(-2px);
        }

        .pageant-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at var(--mouse-x, 50%) var(--mouse-y, 50%), rgba(255, 215, 0, 0.15) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.3s;
            pointer-events: none;
        }

        .pageant-card:hover::before {
            opacity: 1;
        }

        .pageant-heading {
            background: linear-gradient(135deg, #FFD700, #FFA500);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 2px 10px rgba(255, 215, 0, 0.2);
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

        .animate-float {
            animation: float 3s ease-in-out infinite;
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
            position: relative;
            overflow: hidden;
        }

        .glass-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: 
                linear-gradient(45deg, transparent 45%, rgba(255, 215, 0, 0.1) 48%, rgba(255, 215, 0, 0.2) 50%, rgba(255, 215, 0, 0.1) 52%, transparent 55%),
                linear-gradient(-45deg, transparent 45%, rgba(255, 215, 0, 0.1) 48%, rgba(255, 215, 0, 0.2) 50%, rgba(255, 215, 0, 0.1) 52%, transparent 55%);
            background-size: 300% 300%;
            animation: cardShimmer 6s linear infinite;
            pointer-events: none;
        }

        @keyframes cardShimmer {
            0% { background-position: 200% 200%; }
            100% { background-position: -200% -200%; }
        }

        .glass-card:hover {
            border-color: rgba(255, 215, 0, 0.3);
            box-shadow: 
                0 0 20px rgba(255, 215, 0, 0.1),
                0 0 40px rgba(255, 215, 0, 0.05);
            transform: translateY(-2px);
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

        .social-link::after {
            content: '';
            position: absolute;
            inset: -1px;
            background: linear-gradient(45deg, transparent, rgba(255, 215, 0, 0.2), transparent);
            animation: rotate 2s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .social-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 215, 0, 0.2);
        }

        .social-share-btn {
            @apply flex items-center gap-2 px-4 py-2 rounded-full bg-gradient-to-r from-gold/20 to-gold/10
                   hover:from-gold/30 hover:to-gold/20 transition-all duration-300 group border border-gold/20
                   hover:border-gold/40 hover:scale-105 hover:shadow-lg hover:shadow-gold/10;
            position: relative;
            overflow: hidden;
        }

        .social-share-btn::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 215, 0, 0.2) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .social-share-btn:hover::after {
            opacity: 1;
        }

        .social-share-btn {
            @apply flex items-center gap-2 px-4 py-2 rounded-full bg-gradient-to-r from-gold/20 to-gold/10
                   hover:from-gold/30 hover:to-gold/20 transition-all duration-300 group border border-gold/20
                   hover:border-gold/40 hover:scale-105 hover:shadow-lg hover:shadow-gold/10;
        }

        .social-icon-wrap {
            @apply flex items-center justify-center w-8 h-8 rounded-full bg-black/30
                   group-hover:bg-black/40 transition-all duration-300;
        }

        .social-text {
            @apply text-sm font-medium text-gold/90 group-hover:text-gold transition-colors duration-300;
        }

        [x-cloak] { display: none !important; }

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
    <div class="min-h-screen bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900" 
         x-data="{ 
            activeImage: '{{ $candidate->image_url }}', 
            voting: voting(),
            initMouseMove() {
                document.addEventListener('mousemove', (e) => {
                    const cards = document.querySelectorAll('.pageant-card');
                    cards.forEach(card => {
                        const rect = card.getBoundingClientRect();
                        const x = ((e.clientX - rect.left) / card.offsetWidth) * 100;
                        const y = ((e.clientY - rect.top) / card.offsetHeight) * 100;
                        card.style.setProperty('--mouse-x', `${x}%`);
                        card.style.setProperty('--mouse-y', `${y}%`);
                    });
                });
            }
         }"
         x-init="
            voting.votes = {{ json_encode([$candidate->id => $candidate->votes]) }};
            initMouseMove();
         "
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
                <div class="pageant-card hover:border-gold/40 group relative overflow-hidden rounded-2xl p-4 transition-all duration-300 elegant-border">
                    <!-- Crown Icon at the top -->
                    <div class="absolute -top-12 left-1/2 -translate-x-1/2 transform z-10">
                        <div class="relative w-32 h-32 flex items-center justify-center">
                            <!-- Glowing Background -->
                            <div class="absolute inset-0 bg-gradient-to-r from-gold/30 via-gold/10 to-gold/30 rounded-full blur-lg transform scale-150 animate-pulse"></div>
                            
                            <!-- Crown Image -->
                            <div class="relative group transition-transform duration-300 hover:scale-105">
                                <img src="{{ asset('assets/images/crown.png') }}" alt="Crown" class="w-24 h-24 object-contain drop-shadow-[0_0_8px_rgba(255,215,0,0.3)]" />
                                
                                <!-- Animated Sparkles -->
                                <div class="absolute top-0 left-0 w-full h-full pointer-events-none">
                                    <span class="absolute -top-2 left-0 text-xl animate-float" style="animation-delay: 0s">✨</span>
                                    <span class="absolute top-1/2 -right-2 text-xl animate-float" style="animation-delay: 0.3s">✨</span>
                                    <span class="absolute -bottom-2 left-1/2 text-xl animate-float" style="animation-delay: 0.6s">✨</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Title Text Below Crown -->
                        <div class="absolute -bottom-6 left-1/2 transform -translate-x-1/2 whitespace-nowrap">
                            <span class="luxury-text text-sm font-semibold tracking-wider">Miss Heritage International</span>
                        </div>
                    </div>
                    <!-- Country Flag Overlay -->
                    <div class="absolute -right-20 -top-20 z-10 h-40 w-40 rotate-45 overflow-hidden opacity-30">
                        <img src="https://flagcdn.com/w160/{{ strtolower($candidate->country_code) }}.png"
                            alt="{{ $candidate->country }} flag" class="h-full w-full object-cover">
                    </div>
                    <div class="relative aspect-[3/4] overflow-hidden">
                        <img :src="activeImage" alt="{{ $candidate->name }}"
                            class="h-full w-full object-cover transition-all duration-700 group-hover:scale-105 group-hover:brightness-110">

                    </div>

                    <!-- Vote Count Section -->
                    <div class="bg-black/20 p-4 backdrop-blur-sm sm:p-6">
                        <div class="mb-3">
                            <div class="mb-2 flex items-center justify-between">
                                <span class="text-gold/60 text-sm">Current Votes</span>
                                <span class="vote-count text-sm" x-text="5000"></span>
                            </div>
                            <div class="progress-bar">
                                <div :id="'progress-' + 1" class="progress-bar-fill" :style="'width: ' + 10 + '%'"></div>
                            </div>
                        </div>

                        <button :id="'vote-button-' + 1" :disabled="loading"
                            class="vote-button flex w-full items-center justify-center space-x-2 text-sm disabled:cursor-not-allowed disabled:opacity-50">
                            <span>Vote Now</span>
                            <span class="text-base">👑</span>
                        </button>
                    </div>


                </div>

                <!-- Right Side - Contestant Info -->
                <div class="relative space-y-8 px-8">
                    <!-- Basic Info -->
                    <div class="glass-card elegant-border animate-glow rounded-xl p-6 transition-all duration-300">
                        <h1 class="luxury-text relative mb-2 text-3xl font-bold tracking-wider" style="text-shadow: 0 2px 4px rgba(255, 215, 0, 0.2)">
                            <span class="absolute -left-6 top-1/2 -translate-y-1/2 transform">
                                <span class="animate-float inline-block text-2xl" style="animation-delay: 0.2s">✨</span>
                            </span>
                            {{ $candidate->name }}
                            <span class="absolute -right-6 top-1/2 -translate-y-1/2 transform">
                                <span class="animate-float inline-block text-2xl" style="animation-delay: 0.8s">✨</span>
                            </span>
                        </h1>
                        <div class="mb-4 flex items-center gap-3 animate-float" style="animation-duration: 6s;">
                            <img src="https://flagcdn.com/w40/{{ strtolower($candidate->country_code) }}.png"
                                alt="{{ $candidate->country }} flag" class="h-6 rounded shadow-lg">
                            <span class="text-gold/90 font-semibold">{{ $candidate->country }}</span>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-gray-300">
                            <div class="stats-item glass-card rounded-lg p-3">
                                <p class="text-gold/70 text-sm">Age</p>
                                <p class="font-semibold">24 Years</p>
                            </div>
                            <div class="stats-item glass-card rounded-lg p-3">
                                <p class="text-gold/70 text-sm">Height</p>
                                <p class="font-semibold">6 ft</p>
                            </div>
                            <div>
                                <p class="text-gold/70 text-sm">Occupation</p>
                                <p class="text-gray-300">Model</p>
                            </div>
                            <div>
                                <p class="text-gold/70 text-sm">Education</p>
                                <p class="text-gray-300">Bachelor's Degree in Business Administration</p>
                            </div>
                            <div>
                                <p class="text-gold/70 text-sm">Languages</p>
                                <p class="text-gray-300">English, Thai</p>
                            </div>
                        </div>
                    </div>

                    <!-- Bio & Achievements -->
                    <div class="glass-card rounded-xl p-6">
                        <h2 class="text-gold/90 mb-4 text-xl font-semibold">About {{ explode(' ', $candidate->name)[0] }}
                        </h2>
                        <p class="mb-6 leading-relaxed text-gray-300">
                            I am a 25-year-old Thai model and beauty pageant titleholder. I am a passionate advocate for
                            environmental conservation and sustainable development.
                            I am also a strong advocate for women's rights and education. I am currently pursuing a degree
                            in Business Administration from Chulalongkorn University.
                        </p>

                        <div class="space-y-3">
                            <h3 class="text-gold/80 text-lg font-semibold">Achievements</h3>
                            <ul class="list-inside list-disc space-y-2 text-gray-300">
                                <li class="shimmer">Winner of Miss Tourism Thailand 2022</li>
                                <li class="shimmer">Finalist of Miss Earth Thailand 2020</li>
                                <li class="shimmer">First Runner-up of Miss Thailand 2019</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Social Media Links -->
                    @if ($candidate->social_media)
                        <div class="flex justify-center gap-4 py-4">
                            @foreach (json_decode($candidate->social_media, true) as $platform => $link)
                                <a href="{{ $link }}" target="_blank" rel="noopener noreferrer"
                                    class="text-gold hover:text-gold/80 transition-colors duration-300">
                                    <i class="fab fa-{{ strtolower($platform) }} text-2xl"></i>
                                </a>
                            @endforeach
                        </div>
                    @endif

                    <!-- Voting Section -->


                    <!-- Share Section -->
                    <div class="elegant-border mt-6 pt-6 rounded-lg p-4" x-data="{ copied: false }">
                        <div class="text-center mb-4">
                            <span class="luxury-text text-lg font-semibold">Support Your Queen</span>
                            <p class="text-sm text-gray-400 mt-2">Every share brings her closer to the crown</p>
                        </div>
                        
                        <!-- Share Buttons -->
                        <div class="flex flex-col items-center gap-4">
                            <!-- Share URL Input -->
                            <div class="relative w-full max-w-md">
                                <input type="text" value="{{ url()->current() }}" readonly
                                    class="w-full px-4 py-2 bg-black/30 border border-gold/20 rounded-lg text-sm text-gray-300 focus:outline-none focus:border-gold/40"
                                    x-ref="shareUrl">
                                <button @click="$refs.shareUrl.select(); document.execCommand('copy'); copied = true; setTimeout(() => copied = false, 2000)"
                                    class="absolute right-2 top-1/2 -translate-y-1/2 px-3 py-1 text-xs font-medium text-gold/90 hover:text-gold transition-colors">
                                    <span x-show="!copied">Copy</span>
                                    <span x-show="copied" x-cloak>Copied!</span>
                                </button>
                            </div>

                            <!-- Social Share Buttons -->
                            <div class="flex justify-center gap-4">
                                <!-- Facebook -->
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                                    class="social-share-btn" target="_blank" title="Share on Facebook">
                                    <div class="social-icon-wrap">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/>
                                        </svg>
                                    </div>
                                    <span class="social-text">Facebook</span>
                                </a>

                                <!-- Twitter/X -->
                                <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text=Vote for {{ $candidate->name }} in Miss Heritage International!"
                                    class="social-share-btn" target="_blank" title="Share on Twitter">
                                    <div class="social-icon-wrap">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M23.643 4.937c-.835.37-1.732.62-2.675.733.962-.576 1.7-1.49 2.048-2.578-.9.534-1.897.922-2.958 1.13-.85-.904-2.06-1.47-3.4-1.47-2.572 0-4.658 2.086-4.658 4.66 0 .364.042.718.12 1.06-3.873-.195-7.304-2.05-9.602-4.868-.4.69-.63 1.49-.63 2.342 0 1.616.823 3.043 2.072 3.878-.764-.025-1.482-.234-2.11-.583v.06c0 2.257 1.605 4.14 3.737 4.568-.392.106-.803.162-1.227.162-.3 0-.593-.028-.877-.082.593 1.85 2.313 3.198 4.352 3.234-1.595 1.25-3.604 1.995-5.786 1.995-.376 0-.747-.022-1.112-.065 2.062 1.323 4.51 2.093 7.14 2.093 8.57 0 13.255-7.098 13.255-13.254 0-.2-.005-.402-.014-.602.91-.658 1.7-1.477 2.323-2.41z"/>
                                        </svg>
                                    </div>
                                    <span class="social-text">Twitter</span>
                                </a>

                                <!-- WhatsApp -->
                                <a href="https://wa.me/?text=Vote for {{ $candidate->name }} in Miss Heritage International! {{ url()->current() }}"
                                    class="social-share-btn" target="_blank" title="Share on WhatsApp">
                                    <div class="social-icon-wrap">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                        </svg>
                                    </div>
                                    <span class="social-text">WhatsApp</span>
                                </a>
                            </div>
                        </div>
                            <!-- Share Stats -->
                            <div class="mt-6 pt-4 border-t border-gold/10 text-center">
                                <p class="text-sm text-gray-400">Help {{ explode(' ', $candidate->name)[0] }} reach more supporters</p>
                                <div class="mt-2 flex justify-center gap-8">
                                    <div class="text-center">
                                        <span class="block text-xl font-semibold text-gold/90">{{ number_format($candidate->votes) }}</span>
                                        <span class="text-xs text-gray-400">Votes</span>
                                    </div>
                                    <div class="text-center">
                                        <span class="block text-xl font-semibold text-gold/90">{{ rand(50, 200) }}</span>
                                        <span class="text-xs text-gray-400">Shares</span>
                                    </div>
                                </div>
                            </div>
                                    <path
                                        d="M23.44 4.83c-.8.37-1.5.38-2.22.02.93-.56.98-.96 1.32-2.02-.88.52-1.86.9-2.9 1.1-.82-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.03.7.1 1.04-3.77-.2-7.12-2-9.36-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.74-.03-1.44-.23-2.05-.58v.06c0 2.2 1.56 4.03 3.64 4.44-.67.2-1.37.2-2.06.08.58 1.8 2.26 3.12 4.25 3.16C5.78 18.1 3.37 18.74 1 18.46c2 1.3 4.4 2.04 6.97 2.04 8.35 0 12.92-6.92 12.92-12.93 0-.2 0-.4-.02-.6.9-.63 1.96-1.22 2.56-2.14z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
