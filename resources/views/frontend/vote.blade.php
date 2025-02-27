@extends('layouts.frontend-new')

@section('content')
    <style>
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        @keyframes spin-slow {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-spin-slow {
            animation: spin-slow 10s linear infinite;
        }
    </style>
    <div x-data="voting()" data-votes='{{ $candidates->pluck('votes', 'id')->toJson() }}'>

        @php
            $start_date = \Carbon\Carbon::parse($event->voting_start_date);
            $end_date = \Carbon\Carbon::parse($event->voting_end_date);
            $now = \Carbon\Carbon::now();
        @endphp

        <!-- Banner Section -->
        <div class="relative overflow-hidden bg-gradient-to-b from-gray-900 to-gray-800 pb-12 pt-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="relative z-10 text-center">
                    <h1 class="pageant-heading mb-4 text-4xl font-extrabold tracking-tight sm:text-5xl md:text-6xl">
                        {{ $event->name }}
                    </h1>
                    <p class="mt-2 text-xl text-gray-300">Cast your vote for the next heritage queen</p>
                </div>
            </div>
            <!-- Decorative elements -->
            <div class="absolute left-1/2 top-1/2 h-full w-full max-w-7xl -translate-x-1/2 -translate-y-1/2">
                <div class="sparkle absolute left-1/4 top-1/4"></div>
                <div class="sparkle absolute right-1/4 top-3/4" style="animation-delay: 0.5s"></div>
                <div class="sparkle absolute left-1/2 top-1/2" style="animation-delay: 1s"></div>
            </div>
        </div>
        {{-- 
        <!-- Timer Section -->
        <div class="timer-section mx-auto my-8 max-w-4xl rounded-xl px-4 py-8">
            <div class="mb-6 text-center">
                <h2 class="pageant-heading mb-2 text-2xl sm:text-3xl">Voting {{ $now < $start_date ? 'Starts In' : 'Ends In' }}</h2>
                <p class="text-gray-400">{{ $start_date->format('F d, Y') }}</p>
            </div>

            <div class="grid grid-cols-2 gap-4 sm:flex sm:items-center sm:justify-center sm:space-x-4 md:space-x-8" x-data="timer({{ $start_date->timestamp * 1000 }})" x-init="init();">
                <div class="flex flex-col items-center rounded-lg bg-gray-800/50 px-3 py-3 backdrop-blur sm:px-6 sm:py-4">
                    <span x-text="time().days" class="timer-digit text-gold text-2xl font-bold sm:text-4xl lg:text-6xl">00</span>
                    <span class="mt-1 text-sm uppercase tracking-wide text-gray-400 sm:mt-2 sm:text-base">Days</span>
                </div>
                <div class="flex flex-col items-center rounded-lg bg-gray-800/50 px-3 py-3 backdrop-blur sm:px-6 sm:py-4">
                    <span x-text="time().hours" class="timer-digit text-gold text-2xl font-bold sm:text-4xl lg:text-6xl">23</span>
                    <span class="mt-1 text-sm uppercase tracking-wide text-gray-400 sm:mt-2 sm:text-base">Hours</span>
                </div>
                <div class="flex flex-col items-center rounded-lg bg-gray-800/50 px-3 py-3 backdrop-blur sm:px-6 sm:py-4">
                    <span x-text="time().minutes" class="timer-digit text-gold text-2xl font-bold sm:text-4xl lg:text-6xl">59</span>
                    <span class="mt-1 text-sm uppercase tracking-wide text-gray-400 sm:mt-2 sm:text-base">Minutes</span>
                </div>
                <div class="flex flex-col items-center rounded-lg bg-gray-800/50 px-3 py-3 backdrop-blur sm:px-6 sm:py-4">
                    <span x-text="time().seconds" class="timer-digit text-gold text-2xl font-bold sm:text-4xl lg:text-6xl">28</span>
                    <span class="mt-1 text-sm uppercase tracking-wide text-gray-400 sm:mt-2 sm:text-base">Seconds</span>
                </div>
            </div>

            <!-- Live Vote Counter -->
            <div class="live-vote-counter mt-8 rounded-lg px-6 py-4 text-center">
                <div class="text-gold mb-2 font-semibold">Live Votes</div>
                <div class="text-3xl font-bold" x-data="{ count: 0 }" x-init="setInterval(() => count = Math.floor(Math.random() * 1000) + 5000, 3000)">
                    <span x-text="count.toLocaleString()">5,000</span>
                    <span class="ml-2 text-sm text-gray-400">votes</span>
                </div>
            </div>
        </div> --}}

        <!-- Extra Large Modal -->

        <div class="min-h-screen bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 px-4 py-12 sm:px-6 lg:px-8">
            <!-- Success Toast -->
            <div x-show="showVoteSuccess" x-transition:enter="transform ease-out duration-300 transition"
                x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed right-4 top-4 z-50 rounded-lg bg-black/80 p-4 backdrop-blur-sm">
                <div class="flex items-center space-x-2">
                    <span class="text-2xl">👑</span>
                    <p class="text-gold">Thank you for voting! Your vote has been recorded.</p>
                </div>
            </div>
            <div class="mx-auto max-w-7xl">
                <div class="relative mb-16 text-center">
                    <!-- Crown Icon at the top -->
                    <div class="absolute -top-8 left-1/2 z-10 -translate-x-1/2 transform">
                        <div class="relative flex h-24 w-24 items-center justify-center">
                            <!-- Smaller Glowing Background -->
                            <div class="absolute inset-0 scale-[2] transform">
                                <!-- Primary glow -->
                                <div
                                    class="from-gold/30 via-gold/15 to-gold/30 absolute inset-0 animate-pulse rounded-full bg-gradient-to-r blur-lg">
                                </div>
                                <!-- Secondary sparkle effect -->
                                <div class="absolute inset-0 animate-pulse rounded-full bg-gradient-to-r from-yellow-200/20 via-amber-400/15 to-yellow-200/20 blur-md"
                                    style="animation-delay: 0.5s"></div>
                                <!-- Shimmer effect -->
                                <div
                                    class="animate-shimmer via-gold/20 absolute inset-0 rounded-full bg-gradient-to-r from-transparent to-transparent blur-sm">
                                </div>
                            </div>

                            <!-- Crown Image -->
                            <div class="group relative transition-transform duration-300 hover:scale-105">
                                <img src="{{ asset('assets/images/crown.png') }}" alt="Crown"
                                    class="z-100 h-32 w-32 object-contain brightness-105 drop-shadow-[0_0_10px_rgba(255,215,0,0.4)] filter" />

                                <!-- Animated Sparkles -->
                                <div class="pointer-events-none absolute left-0 top-0 h-full w-full">
                                    <span class="animate-float absolute -top-1 left-0 text-lg"
                                        style="animation-delay: 0s">✨</span>
                                    <span class="animate-float absolute -right-1 top-1/2 text-lg"
                                        style="animation-delay: 0.3s">✨</span>
                                    <span class="animate-float absolute -bottom-1 left-1/2 text-lg"
                                        style="animation-delay: 0.6s">✨</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6 flex items-center justify-center gap-2">
                        <img src="https://heritagepageant.com/wp-content/uploads/2023/06/logo-1-68x65.png"
                            alt="Heritage Pageants Logo" class="h-20 sm:h-32 md:h-32">
                    </div>
                    <h1
                        class="pageant-heading mb-4 text-4xl font-extrabold tracking-tight sm:text-5xl md:text-6xl lg:text-7xl">
                        Miss Heritage International 2025
                    </h1>
                    <p class="text-gold/80 mx-auto mb-4 max-w-3xl text-xl font-light">
                        Celebrating Peace, Environment, Tourism, Culture & Heritage
                    </p>
                    <div class="text-gold/60 mb-8 flex flex-wrap justify-center gap-2 text-xs sm:gap-4 sm:text-sm">
                        <span class="border-gold/20 rounded-full border px-3 py-1">#Peace</span>
                        <span class="border-gold/20 rounded-full border px-3 py-1">#Environment</span>
                        <span class="border-gold/20 rounded-full border px-3 py-1">#Tourism</span>
                        <span class="border-gold/20 rounded-full border px-3 py-1">#Culture</span>
                        <span class="border-gold/20 rounded-full border px-3 py-1">#Heritage</span>
                    </div>
                </div>

                <!-- Live Stats -->
<div class="mb-16" x-data="{
    countdown: {
        days: 0,
        hours: 0,
        minutes: 0,
        seconds: 0
    },
    previousValues: {
        days: 0,
        hours: 0,
        minutes: 0,
        seconds: 0
    },
    pulseStates: {
        days: false,
        hours: false,
        minutes: false,
        seconds: false
    },
    initCountdown() {
        const endDate = new Date('{{ $event->voting_end_date }}').getTime();
        const updateTimer = () => {
            const now = new Date().getTime();
            const distance = now - endDate;
            
            // Store previous values
            Object.keys(this.countdown).forEach(key => {
                this.previousValues[key] = this.countdown[key];
            });
            
            // Update countdown values
            this.countdown = {
                days: Math.floor(distance / (1000 * 60 * 60 * 24)),
                hours: Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
                minutes: Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)),
                seconds: Math.floor((distance % (1000 * 60)) / 1000)
            };
            
            // Check for changes and trigger pulse
            Object.keys(this.countdown).forEach(key => {
                if (this.countdown[key] !== this.previousValues[key]) {
                    this.pulseStates[key] = true;
                    setTimeout(() => {
                        this.pulseStates[key] = false;
                    }, 300);
                }
            });
        };
        updateTimer();
        setInterval(updateTimer, 1000);
    }
}" x-init="initCountdown()">
    <!-- Stats Grid -->
    <div class="mx-auto grid gap-4 px-4 sm:grid-cols-3 lg:gap-6">
        <!-- Total Votes -->
        <div class="pageant-card group relative overflow-hidden rounded-2xl p-4 transition-all duration-500 hover:scale-[1.02] hover:shadow-[0_0_50px_0_rgba(255,215,0,0.15)] sm:p-6"
            x-data="{ isHovered: false }"
            @mouseenter="isHovered = true"
            @mouseleave="isHovered = false">
            <!-- Background Effects -->
            <div class="from-gold/10 via-gold/5 to-gold/10 absolute inset-0 bg-gradient-to-br opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
            <div class="bg-gold/5 absolute -left-10 -top-10 h-20 w-20 rounded-full blur-xl transition-all duration-500"
                :class="{ 'bg-gold/10 scale-150': isHovered }"></div>
            <div class="bg-gold/5 absolute -bottom-10 -right-10 h-20 w-20 rounded-full blur-xl transition-all duration-500"
                :class="{ 'bg-gold/10 scale-150': isHovered }"></div>
            <!-- Sparkle Effects -->
            <div class="pointer-events-none absolute inset-0 opacity-0 transition-opacity duration-300"
                :class="{ 'opacity-100': isHovered }">
                <span class="text-gold/30 absolute left-1/4 top-1/4 text-sm">✨</span>
                <span class="text-gold/30 absolute right-1/4 top-3/4 text-sm">✨</span>
                <span class="text-gold/30 absolute left-3/4 top-1/2 text-sm">✨</span>
            </div>
            
            <!-- Content -->
            <div class="relative flex flex-col items-center justify-center space-y-3">
                <div class="text-gold/60 text-sm font-medium uppercase tracking-wider">Total Votes</div>
                <div class="text-gold text-3xl font-bold transition-all duration-300 group-hover:scale-110 sm:text-4xl lg:text-5xl" x-text="formatNumber(getTotalVotes())">0</div>
                <div class="text-gold/40 group-hover:text-gold/60 text-xs transition-all duration-300">and counting...</div>
            </div>
        </div>

        <!-- Time Remaining -->
        <div class="pageant-card group relative col-span-2 overflow-hidden rounded-2xl p-4 transition-all duration-500 hover:scale-[1.02] hover:shadow-[0_0_50px_0_rgba(255,215,0,0.15)] sm:col-span-1 sm:p-6"
            x-data="{ isHovered: false }"
            @mouseenter="isHovered = true"
            @mouseleave="isHovered = false">
            <!-- Background Effects -->
            <div class="from-gold/10 via-gold/5 to-gold/10 absolute inset-0 bg-gradient-to-br opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
            <div class="bg-gold/5 absolute -left-10 -top-10 h-20 w-20 rounded-full blur-xl transition-all duration-500"
                :class="{ 'bg-gold/10 scale-150': isHovered }">
            </div>
            <div class="bg-gold/5 absolute -bottom-10 -right-10 h-20 w-20 rounded-full blur-xl transition-all duration-500"
                :class="{ 'bg-gold/10 scale-150': isHovered }">
            </div>
            <!-- Sparkle Effects -->
            <div class="pointer-events-none absolute inset-0 opacity-0 transition-opacity duration-300"
                :class="{ 'opacity-100': isHovered }">
                <span class="text-gold/30 absolute left-1/4 top-1/4 text-sm">✨</span>
                <span class="text-gold/30 absolute right-1/4 top-3/4 text-sm">✨</span>
                <span class="text-gold/30 absolute left-3/4 top-1/2 text-sm">✨</span>
            </div>
            
            <!-- Content -->
            <div class="relative space-y-3">
                <div class="text-gold/60 text-center text-sm font-medium uppercase tracking-wider">Time Remaining</div>
                <div class="grid grid-cols-4 gap-2 sm:gap-3">
                    <div class="text-center">
                        <div class="relative overflow-hidden rounded-lg bg-black/20 p-2 backdrop-blur-sm transition-all duration-300 group-hover:bg-black/30">
                            <span class="text-gold bg-gradient-to-r from-amber-200 to-yellow-500 bg-clip-text text-xl font-bold text-transparent sm:text-2xl lg:text-3xl" :class="{ 'animate-pulse': pulseStates.days }" x-text="countdown.days">0</span>
                            <span class="text-gold/60 block text-xs font-medium">Days</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="relative overflow-hidden rounded-lg bg-black/20 p-2 backdrop-blur-sm transition-all duration-300 group-hover:bg-black/30">
                            <span class="text-gold bg-gradient-to-r from-amber-200 to-yellow-500 bg-clip-text text-xl font-bold text-transparent sm:text-2xl lg:text-3xl" :class="{ 'animate-pulse': pulseStates.hours }" x-text="countdown.hours">0</span>
                            <span class="text-gold/60 block text-xs font-medium">Hours</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="relative overflow-hidden rounded-lg bg-black/20 p-2 backdrop-blur-sm transition-all duration-300 group-hover:bg-black/30">
                            <span class="text-gold bg-gradient-to-r from-amber-200 to-yellow-500 bg-clip-text text-xl font-bold text-transparent sm:text-2xl lg:text-3xl" :class="{ 'animate-pulse': pulseStates.minutes }" x-text="countdown.minutes">0</span>
                            <span class="text-gold/60 block text-xs font-medium">Minutes</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="relative overflow-hidden rounded-lg bg-black/20 p-2 backdrop-blur-sm transition-all duration-300 group-hover:bg-black/30">
                            <span class="text-gold bg-gradient-to-r from-amber-200 to-yellow-500 bg-clip-text text-xl font-bold text-transparent sm:text-2xl lg:text-3xl" :class="{ 'animate-pulse': pulseStates.seconds }" x-text="countdown.seconds">0</span>
                            <span class="text-gold/60 block text-xs font-medium">Seconds</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contestants Count -->
        <div class="pageant-card group relative overflow-hidden rounded-2xl p-4 transition-all duration-500 hover:scale-[1.02] hover:shadow-[0_0_50px_0_rgba(255,215,0,0.15)] sm:p-6"
            x-data="{ isHovered: false }"
            @mouseenter="isHovered = true"
            @mouseleave="isHovered = false">
            <!-- Background Effects -->
            <div class="from-gold/10 via-gold/5 to-gold/10 absolute inset-0 bg-gradient-to-br opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
            <div class="bg-gold/5 absolute -left-10 -top-10 h-20 w-20 rounded-full blur-xl transition-all duration-500"
                :class="{ 'bg-gold/10 scale-150': isHovered }"></div>
            <div class="bg-gold/5 absolute -bottom-10 -right-10 h-20 w-20 rounded-full blur-xl transition-all duration-500"
                :class="{ 'bg-gold/10 scale-150': isHovered }"></div>
            <!-- Sparkle Effects -->
            <div class="pointer-events-none absolute inset-0 opacity-0 transition-opacity duration-300"
                :class="{ 'opacity-100': isHovered }">
                <span class="text-gold/30 absolute left-1/4 top-1/4 text-sm">✨</span>
                <span class="text-gold/30 absolute right-1/4 top-3/4 text-sm">✨</span>
                <span class="text-gold/30 absolute left-3/4 top-1/2 text-sm">✨</span>
            </div>
            
            <!-- Content -->
            <div class="relative flex flex-col items-center justify-center space-y-3">
                <div class="text-gold/60 text-sm font-medium uppercase tracking-wider">Contestants</div>
                <div class="relative">
                    <div class="text-gold bg-gradient-to-r from-amber-200 to-yellow-500 bg-clip-text text-3xl font-bold text-transparent transition-all duration-300 group-hover:scale-110 sm:text-4xl lg:text-5xl">{{ $candidates->count() }}</div>
                    <div class="text-gold/40 group-hover:text-gold/60 absolute -right-3 top-0 text-lg transition-all duration-300 group-hover:rotate-12 group-hover:scale-110">✨</div>
                </div>
                <div class="text-gold/40 group-hover:text-gold/60 text-xs transition-all duration-300">beautiful contestants</div>
                {{-- <div class="text-gold/40 h-12 w-12 transform transition-transform duration-300 group-hover:rotate-12 group-hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor"
                        class="group-hover:stroke-gold transition-colors duration-300">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div> --}}
            </div>
        </div>
    </div>
</div>

                <!-- Title Holders Section -->
                <div class="mb-16">
                    <!-- Section Title with Crown Animation -->
                    <div class="relative mb-12 text-center">
                        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                            <div
                                class="animate-spin-slow from-gold/20 to-gold/20 h-32 w-32 rounded-full bg-gradient-to-r via-transparent blur-xl">
                            </div>
                        </div>
                        <h2 class="font-playfair text-gold relative inline-block text-3xl font-bold sm:text-4xl">
                            <span class="absolute -left-8 top-1/2 -translate-y-1/2">
                                <span class="animate-float inline-block text-3xl">⭐</span>
                            </span>
                            Leading Contestants
                            <span class="absolute -right-8 top-1/2 -translate-y-1/2">
                                <span class="animate-float inline-block text-3xl" style="animation-delay: 0.5s">⭐</span>
                            </span>
                        </h2>
                        <p class="text-gold/60 mt-4">Vote for your favorite contestant and help them win the crown!</p>
                    </div>

                    <!-- Title Holders Grid -->
                    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($candidates->where('is_featured', true)->take(3) as $index => $candidate)
                            <!-- Title Holder Card -->
                            <div class="group relative transform-gpu transition-all duration-500 hover:scale-[1.02]">
                                <!-- Rank Badge -->
                                <div class="absolute -right-4 -top-4 z-20">
                                    @php
                                        $rankStyles = [
                                            1 => [
                                                'bg' => 'from-yellow-400 to-yellow-600',
                                                'icon' => '⭐',
                                                'text' => 'Leading',
                                                'glow' => 'gold',
                                            ],
                                            2 => [
                                                'bg' => 'from-gray-300 to-gray-500',
                                                'icon' => '⭐',
                                                'text' => 'Runner Up',
                                                'glow' => 'silver',
                                            ],
                                            3 => [
                                                'bg' => 'from-amber-600 to-amber-800',
                                                'icon' => '⭐',
                                                'text' => 'Top 3',
                                                'glow' => 'bronze',
                                            ],
                                        ];
                                        $style = $rankStyles[$index + 1] ?? [
                                            'bg' => 'from-purple-400 to-purple-600',
                                            'icon' => '⭐',
                                            'text' => 'Finalist',
                                            'glow' => 'purple',
                                        ];
                                    @endphp
                                    <div class="animate-float relative">
                                        <!-- Glowing Effect -->
                                        <div
                                            class="absolute inset-0 animate-pulse rounded-full bg-gradient-to-br {{ $style['bg'] }} opacity-50 blur-xl">
                                        </div>
                                        <!-- Badge Container -->
                                        <div
                                            class="relative flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br {{ $style['bg'] }} p-1">
                                            <div
                                                class="flex h-full w-full items-center justify-center rounded-full bg-black/50 backdrop-blur-sm">
                                                <span class="text-2xl">{{ $style['icon'] }}</span>
                                            </div>
                                        </div>
                                        <!-- Rank Number -->
                                        <div
                                            class="text-gold absolute -bottom-2 left-1/2 -translate-x-1/2 rounded-full bg-black/50 px-2 py-0.5 text-xs font-bold backdrop-blur-sm">
                                            #{{ $index + 1 }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Content -->
                                <div
                                    class="group relative overflow-hidden rounded-xl bg-gradient-to-b from-black/40 to-black/60 shadow-lg backdrop-blur-sm transition-all duration-300">
                                    <!-- Background Effects -->
                                    <div
                                        class="bg-gold/20 group-hover:bg-gold/30 absolute -left-20 -top-20 h-40 w-40 rounded-full blur-3xl transition-all duration-500">
                                    </div>
                                    <div
                                        class="bg-gold/20 group-hover:bg-gold/30 absolute -bottom-20 -right-20 h-40 w-40 rounded-full blur-3xl transition-all duration-500">
                                    </div>

                                    <!-- Image Section -->
                                    <div class="relative aspect-[3/4] overflow-hidden">
                                        <img src="{{ $candidate['image_url'] }}" alt="{{ $candidate['name'] }}"
                                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">

                                        <!-- Gradient Overlay -->
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent opacity-90">
                                        </div>

                                        <!-- Content Overlay -->
                                        <div class="absolute bottom-0 left-0 right-0 p-6 text-center">
                                            <!-- Name and Title -->
                                            <div class="mb-4">
                                                <div class="mb-1 flex items-center justify-center gap-2">
                                                    <img src="https://flagcdn.com/w40/{{ strtolower($candidate['country_code']) }}.png"
                                                        alt="{{ $candidate['country'] }} flag"
                                                        class="h-5 w-7 rounded shadow-lg">
                                                </div>
                                                <h3 class="font-playfair mb-2 text-2xl font-bold text-white">
                                                    {{ $candidate['name'] }}</h3>
                                                <p class="text-gold text-lg font-medium">Currently #{{ $index + 1 }}
                                                </p>
                                                <p class="text-gold/80 text-sm">{{ $candidate['title'] }}</p>
                                            </div>

                                            <!-- Vote Stats -->
                                            <div class="mb-4 rounded-lg bg-black/30 p-3 backdrop-blur-sm">
                                                <div class="mb-2 flex items-center justify-between">
                                                    <span class="text-gold/60 text-sm">Total Votes</span>
                                                    <span class="text-gold font-bold"
                                                        x-text="formatNumber(votes[{{ $index + 1 }}])">0</span>
                                                </div>
                                                <div class="relative h-2 overflow-hidden rounded-full bg-black/30">
                                                    <div class="absolute inset-0 bg-gradient-to-r {{ $style['bg'] }}"
                                                        :style="'width: ' + getVotePercentage({{ $index + 1 }}) + '%'"
                                                        style="transition: width 1s ease-in-out"></div>
                                                </div>
                                                <div class="mt-1 text-right">
                                                    <span class="text-gold/60 text-xs"
                                                        x-text="getVotePercentage({{ $index + 1 }}) + '%'">0%</span>
                                                </div>
                                            </div>

                                            <!-- Vote Button -->
                                            <button @click="castVote({{ $index + 1 }})" :disabled="loading"
                                                class="group relative w-full overflow-hidden rounded-full bg-gradient-to-r {{ $style['bg'] }} p-[2px] transition-all duration-300 hover:scale-105 hover:shadow-[0_0_2rem_0_rgba(255,215,0,0.3)]">
                                                <div
                                                    class="relative flex h-full w-full items-center justify-center gap-2 rounded-full bg-black/50 px-6 py-2 backdrop-blur-sm transition-all duration-300 group-hover:bg-opacity-90">
                                                    <span class="text-white">Vote Now</span>
                                                    <span class="text-lg">{{ $style['icon'] }}</span>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Candidates Grid -->
                <!-- Featured Contestants -->
                <div class="mb-12">
                    <h2 class="font-playfair text-gold mb-6 text-center text-2xl font-bold">Current Title Holders</h2>
                    <div class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach ($candidates->where('is_featured', true) as $index => $candidate)
                            <div class="pageant-card group relative overflow-hidden {{ $index < 2 ? 'sm:col-span-1' : '' }}"
                                :class="{ 'animate-glow': loading && selectedCandidate === {{ $index + 1 }} }">
                                <div class="relative aspect-[3/4] overflow-hidden">
                                    <img src="{{ $candidate['image_url'] ?? 'https://heritagepageant.com/wp-content/uploads/2024/05/Picture1.png' }}"
                                        alt="{{ $candidate['name'] }}"
                                        class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    <!-- Always visible on mobile, hover on desktop -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent opacity-100 transition-opacity duration-300 sm:opacity-0 sm:group-hover:opacity-100">
                                    </div>
                                    <div
                                        class="absolute bottom-0 left-0 right-0 transform-none p-4 transition-transform duration-300 sm:translate-y-full sm:p-6 sm:group-hover:translate-y-0">
                                        <div class="mb-2 flex items-center gap-2">
                                            <img src="https://flagcdn.com/w40/{{ strtolower($candidate['country_code']) }}.png"
                                                alt="{{ $candidate['country'] }} flag" class="h-4 w-6 rounded shadow">
                                            <h3 class="font-playfair text-gold text-xl font-bold sm:text-2xl">
                                                {{ $candidate['name'] }}</h3>
                                        </div>
                                        <p class="text-gold/80 mb-1 text-sm sm:text-base">{{ $candidate['title'] }}</p>
                                        <p class="text-xs text-white/70 sm:text-sm">Focus: {{ $candidate['focus_area'] }}
                                        </p>
                                        <div class="mt-2 flex flex-wrap gap-2 sm:mt-3">
                                            <span class="bg-gold/10 text-gold/90 rounded-full px-2 py-1 text-xs">PETCH
                                                Ambassador</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Vote Count Section -->
                                <div class="bg-black/20 p-4 backdrop-blur-sm sm:p-6">
                                    <div class="mb-3">
                                        <div class="mb-2 flex items-center justify-between">
                                            <span class="text-gold/60 text-sm">Current Votes</span>
                                            <span class="vote-count text-sm"
                                                x-text="formatNumber(votes[{{ $index + 1 }}])"></span>
                                        </div>
                                        <div class="progress-bar">
                                            <div :id="'progress-' + {{ $index + 1 }}" class="progress-bar-fill"
                                                :style="'width: ' + getVotePercentage({{ $index + 1 }}) + '%'"></div>
                                        </div>
                                    </div>

                                    <button :id="'vote-button-' + {{ $index + 1 }}"
                                        @click="castVote({{ $index + 1 }}); selectedCandidate = {{ $index + 1 }}"
                                        :disabled="loading"
                                        class="vote-button flex w-full items-center justify-center space-x-2 text-sm disabled:cursor-not-allowed disabled:opacity-50">
                                        <span>Vote Now</span>
                                        <span class="text-base">👑</span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Other Contestants -->
                <h2 class="font-playfair text-gold mb-6 text-center text-2xl font-bold">Regional Title Holders</h2>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($candidates->where('is_featured', false) as $index => $candidate)
                        <div class="pageant-card group"
                            :class="{ 'animate-glow': loading && selectedCandidate === {{ $index + 1 }} }">
                            <a href="{{ route('vote.show', $candidate['id']) }}" class="block">
                                <div class="relative overflow-hidden">
                                    <img src="{{ $candidate['image_url'] ?? 'https://heritagepageant.com/wp-content/uploads/2024/05/Picture1.png' }}"
                                        alt="{{ $candidate['name'] }}"
                                        class="h-80 w-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                    </div>
                                    <div
                                        class="absolute bottom-0 left-0 right-0 translate-y-full p-6 transition-transform duration-300 group-hover:translate-y-0">
                                        <div class="mb-2 flex items-center gap-2">
                                            <img src="https://flagcdn.com/w40/{{ strtolower($candidate['country_code']) }}.png"
                                                alt="{{ $candidate['country'] }} flag" class="h-4 w-6 rounded shadow">
                                            <h3 class="font-playfair text-gold text-2xl font-bold">
                                                {{ $candidate['name'] }}</h3>
                                        </div>
                                        <p class="text-gold/80 mb-1">{{ $candidate['title'] }}</p>
                                        <p class="text-sm text-white/70">Focus: {{ $candidate['focus_area'] }}</p>
                                        <div class="mt-3 flex gap-2">
                                            <span class="bg-gold/10 text-gold/90 rounded-full px-2 py-1 text-xs">PETCH
                                                Ambassador</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-6">
                                    <div class="mb-4">
                                        <div class="mb-2 flex items-center justify-between">
                                            <span class="text-gold/60">Current Votes</span>
                                            <span class="vote-count"
                                                x-text="formatNumber(votes[{{ $index + 1 }}])"></span>
                                        </div>
                                        <div class="progress-bar">
                                            <div :id="'progress-' + {{ $index + 1 }}" class="progress-bar-fill"
                                                :style="'width: ' + getVotePercentage({{ $index + 1 }}) + '%'"></div>
                                        </div>
                                        <div class="mt-1 text-right">
                                            <span class="text-gold/60 text-sm"
                                                x-text="getVotePercentage({{ $index + 1 }}) + '%'"></span>
                                        </div>
                                    </div>

                                    <button :id="'vote-button-' + {{ $index + 1 }}"
                                        @click="castVote({{ $index + 1 }}); selectedCandidate = {{ $index + 1 }}"
                                        :disabled="loading"
                                        class="vote-button flex w-full items-center justify-center space-x-2 disabled:cursor-not-allowed disabled:opacity-50">
                                        <span>Vote Now</span>
                                        <span class="text-lg">👑</span>
                                    </button>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('votingData', () => ({
                    totalVotes: 500,
                    showDetailModal: false,
                    selectedCandidate: null,
                    candidates: @json($candidates),
                    showCandidateDetail(candidateData) {
                        this.selectedCandidate = JSON.parse(candidateData);
                        this.showDetailModal = true;
                    },
                    updateChart() {
                        // Logic to update the chart
                    }
                }))
            })
        </script>
    @endpush
@endsection
