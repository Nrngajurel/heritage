@extends('layouts.frontend-new')

@section('title', 'Voting')

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
    @if ($event)
        
    <div x-data="voting()" data-votes='{{ $event->contestants->pluck('votes', 'id')->toJson() }}' x-cloak>

        @php
            $start_date = \Carbon\Carbon::parse($event->voting_start_date);
            $end_date = \Carbon\Carbon::parse($event->voting_end_date);
            $now = \Carbon\Carbon::now();
        @endphp



        <div x-show="activeShare" 
            @click.away="activeShare = null; copied = false" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
            class="z-50 fixed inset-0 flex justify-center items-center bg-black/50 backdrop-blur-sm">
            <div class="bg-neutral-900 mx-4 p-6 border border-gold/20 rounded-lg w-full max-w-lg hover:scale-[1.02] transition-all duration-300 transform">
                <div class="flex justify-between items-center mb-5">
                    <h2 class="font-semibold text-gold text-xl animate-pulse"
                        x-text="`Share ${activeShare ? activeShare.name : ''} for Vote`"></h2>
                    <button @click="activeShare = null"
                        class="text-gold/70 hover:text-gold text-xl hover:scale-110 transition-all duration-300">&times;</button>
                </div>

                <!-- Your existing share popup here -->
                <div class="flex flex-col items-center gap-4 sm:gap-5">
                    <!-- Share Buttons -->
                    <div class="flex flex-col items-center gap-4 sm:gap-5">
                        <!-- Share URL Input -->
                        <div class="relative w-full max-w-md">
                            <input type="text" :value="voteUrl" readonly
                                class="bg-black/30 px-4 sm:px-5 py-3 border border-gold/20 hover:border-gold/40 focus:border-gold/40 rounded-lg focus:outline-none w-full text-gray-300 text-sm sm:text-base transition-all duration-300"
                                x-ref="shareUrl">
                            <button
                                @click="$refs.shareUrl.select(); document.execCommand('copy'); copied = true; setTimeout(() => copied = false, 2000)"
                                class="top-1/2 right-2 absolute px-4 py-2 font-medium text-gold/90 hover:text-gold text-sm hover:scale-110 transition-all -translate-y-1/2 duration-300">
                                <span x-show="!copied" class="transition-opacity duration-300">Copy</span>
                                <span x-show="copied" x-cloak class="transition-opacity duration-300">Copied!</span>
                            </button>
                        </div>

                        <!-- Social Share Buttons -->
                        <div class="gap-3 sm:gap-4 grid grid-cols-5 mx-auto sm:p-3 px-2 py-3 w-full max-w-xl">
                            <p class="col-span-5 mb-2 sm:mb-3 text-gray-400 text-sm sm:text-base text-center"
                                x-text="`Share ${activeShare ? activeShare.name : ''} Journey`"></p>
                            <a :href="`https://www.instagram.com/create/story?url=${voteUrl}`"
                                class="flex justify-center items-center bg-gold/10 hover:bg-gold/20 hover:shadow-gold/10 hover:shadow-lg rounded-full w-12 sm:w-14 h-12 sm:h-14 transition-all duration-300 social-share-btn"
                                target="_blank" title="Share on Instagram">
                                <svg class="w-6 sm:w-7 h-6 sm:h-7" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </a>
                            <a :href="`https://www.facebook.com/sharer/sharer.php?u=${voteUrl}`"
                                class="flex justify-center items-center bg-gold/10 hover:bg-gold/20 hover:shadow-gold/10 hover:shadow-lg rounded-full w-12 sm:w-14 h-12 sm:h-14 transition-all duration-300 social-share-btn"
                                target="_blank" title="Share on Facebook">
                                <svg class="w-6 sm:w-7 h-6 sm:h-7" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z" />
                                </svg>
                            </a>
                            <a :href="`https://pinterest.com/pin/create/button/?url=${voteUrl}&media=${activeShare?.image}&description=Vote for ${activeShare?.name} in Miss Heritage International!`"
                                class="flex justify-center items-center bg-gold/10 hover:bg-gold/20 hover:shadow-gold/10 hover:shadow-lg rounded-full w-12 sm:w-14 h-12 sm:h-14 transition-all duration-300 social-share-btn"
                                target="_blank" title="Share on Pinterest">
                                <svg class="w-6 sm:w-7 h-6 sm:h-7" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0C5.373 0 0 5.372 0 12c0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738.098.119.112.224.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.631-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24 12 24c6.627 0 12-5.373 12-12 0-6.628-5.373-12-12-12z" />
                                </svg>
                            </a>
                            <a :href="`https://twitter.com/intent/tweet?url=${voteUrl}&text=Vote for ${activeShare?.name} in Miss Heritage International!`"
                                class="flex justify-center items-center bg-gold/10 hover:bg-gold/20 hover:shadow-gold/10 hover:shadow-lg rounded-full w-10 sm:w-12 h-10 sm:h-12 transition-all duration-300 social-share-btn"
                                target="_blank" title="Share on Twitter">
                                <svg class="w-5 sm:w-6 h-5 sm:h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M23.643 4.937c-.835.37-1.732.62-2.675.733.962-.576 1.7-1.49 2.048-2.578-.9.534-1.897.922-2.958 1.13-.85-.904-2.06-1.47-3.4-1.47-2.572 0-4.658 2.086-4.658 4.66 0 .364.042.718.12 1.06-3.873-.195-7.304-2.05-9.602-4.868-.4.69-.63 1.49-.63 2.342 0 1.616.823 3.043 2.072 3.878-.764-.025-1.482-.234-2.11-.583v.06c0 2.257 1.605 4.14 3.737 4.568-.392.106-.803.162-1.227.162-.3 0-.593-.028-.877-.082.593 1.85 2.313 3.198 4.352 3.234-1.595 1.25-3.604 1.995-5.786 1.995-.376 0-.747-.022-1.112-.065 2.062 1.323 4.51 2.093 7.14 2.093 8.57 0 13.255-7.098 13.255-13.254 0-.2-.005-.402-.014-.602.91-.658 1.7-1.477 2.323-2.41z" />
                                </svg>
                            </a>
                            <a :href="`https://wa.me/?text=Vote for ${activeShare?.name} in Miss Heritage International! ${voteUrl}`"
                                class="flex justify-center items-center bg-gold/10 hover:bg-gold/20 hover:shadow-gold/10 hover:shadow-lg rounded-full w-10 sm:w-12 h-10 sm:h-12 transition-all duration-300 social-share-btn"
                                target="_blank" title="Share on WhatsApp">
                                <svg class="w-5 sm:w-6 h-5 sm:h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Banner Section -->
        <div class="relative bg-gradient-to-b from-gray-900 to-gray-800 pt-24 pb-12 overflow-hidden">
            <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
                <div class="z-10 relative text-center">
                    <h1 class="pageant-heading">
                        {{ $event->name }}
                    </h1>
                    <p class="mt-2 text-gray-300 text-xl">Cast your vote for the next heritage queen</p>
                </div>
            </div>
            <!-- Decorative elements -->
            <div class="top-1/2 left-1/2 absolute w-full max-w-7xl h-full -translate-x-1/2 -translate-y-1/2">
                <div class="top-1/4 left-1/4 absolute sparkle"></div>
                <div class="top-3/4 right-1/4 absolute sparkle" style="animation-delay: 0.5s"></div>
                <div class="top-1/2 left-1/2 absolute sparkle" style="animation-delay: 1s"></div>
            </div>
        </div>

        <!-- Extra Large Modal -->

        <div class="bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 px-4 sm:px-6 lg:px-8 py-12 min-h-screen">
            <!-- Success Toast -->
            <div x-show="showVoteSuccess" x-transition:enter="transform ease-out duration-300 transition"
                x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="top-4 right-4 z-50 fixed bg-black/80 backdrop-blur-sm p-4 rounded-lg">
                <div class="flex items-center space-x-2">
                    <span class="text-2xl">👑</span>
                    <p class="text-gold">Thank you for voting! Your vote has been recorded.</p>
                </div>
            </div>
            <div class="mx-auto max-w-7xl">
                <div class="relative mb-16 text-center">
                    <!-- Crown Icon at the top -->
                    <div class="-top-8 left-1/2 z-10 absolute -translate-x-1/2 transform">
                        <div class="relative flex justify-center items-center w-24 h-24">
                            <!-- Smaller Glowing Background -->
                            <div class="absolute inset-0 scale-[2] transform">
                                <!-- Primary glow -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-gold/30 via-gold/15 to-gold/30 blur-lg rounded-full animate-pulse">
                                </div>
                                <!-- Secondary sparkle effect -->
                                <div class="absolute inset-0 bg-gradient-to-r from-yellow-200/20 via-amber-400/15 to-yellow-200/20 blur-md rounded-full animate-pulse"
                                    style="animation-delay: 0.5s"></div>
                                <!-- Shimmer effect -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-transparent via-gold/20 to-transparent blur-sm rounded-full animate-shimmer">
                                </div>
                            </div>

                            <!-- Crown Image -->
                            <div class="group relative hover:scale-105 transition-transform duration-300">
                                {{-- <img src="{{ asset('assets/images/crown.png') }}" alt="Crown"
                                    class="z-100 drop-shadow-[0_0_10px_rgba(255,215,0,0.4)] brightness-105 w-32 h-32 object-contain filter" /> --}}

                                <!-- Animated Sparkles -->
                                <div class="top-0 left-0 absolute w-full h-full pointer-events-none">
                                    <span class="-top-1 left-0 absolute text-lg animate-float"
                                        style="animation-delay: 0s">✨</span>
                                    <span class="top-1/2 -right-1 absolute text-lg animate-float"
                                        style="animation-delay: 0.3s">✨</span>
                                    <span class="-bottom-1 left-1/2 absolute text-lg animate-float"
                                        style="animation-delay: 0.6s">✨</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center items-center gap-2 mb-6">
                        <img src="{{ asset('logo.png') }}" alt="Heritage Pageants Logo" class="h-20 sm:h-32 md:h-32">
                    </div>
                    <h1 class="pageant-heading">
                        {{ $event->title }}
                    </h1>
                    <p class="mx-auto mb-4 max-w-3xl font-light text-gold/80 text-xl">
                        Celebrating Peace, Environment, Tourism, Culture & Heritage
                    </p>
                    <div class="flex flex-wrap justify-center gap-2 sm:gap-4 mb-8 text-gold/60 text-xs sm:text-sm">
                        <span class="px-3 py-1 border border-gold/20 rounded-full">#Peace</span>
                        <span class="px-3 py-1 border border-gold/20 rounded-full">#Environment</span>
                        <span class="px-3 py-1 border border-gold/20 rounded-full">#Tourism</span>
                        <span class="px-3 py-1 border border-gold/20 rounded-full">#Culture</span>
                        <span class="px-3 py-1 border border-gold/20 rounded-full">#Heritage</span>
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
                            const distance = endDate - now;
                
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
                    <div class="gap-4 lg:gap-6 grid sm:grid-cols-3 mx-auto px-4">
                        <!-- Total Votes -->
                        <div class="group relative col-span-2 md:col-span-1 hover:shadow-[0_0_50px_0_rgba(255,215,0,0.15)] p-4 sm:p-6 rounded-2xl overflow-hidden hover:scale-[1.02] transition-all duration-500 pageant-card"
                            x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                            <!-- Background Effects -->
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-gold/10 via-gold/5 to-gold/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            </div>
                            <div class="-top-10 -left-10 absolute bg-gold/5 blur-xl rounded-full w-20 h-20 transition-all duration-500"
                                :class="{ 'bg-gold/10 scale-150': isHovered }"></div>
                            <div class="-right-10 -bottom-10 absolute bg-gold/5 blur-xl rounded-full w-20 h-20 transition-all duration-500"
                                :class="{ 'bg-gold/10 scale-150': isHovered }"></div>
                            <!-- Sparkle Effects -->
                            <div class="absolute inset-0 opacity-0 transition-opacity duration-300 pointer-events-none"
                                :class="{ 'opacity-100': isHovered }">
                                <span class="top-1/4 left-1/4 absolute text-gold/30 text-sm">✨</span>
                                <span class="top-3/4 right-1/4 absolute text-gold/30 text-sm">✨</span>
                                <span class="top-1/2 left-3/4 absolute text-gold/30 text-sm">✨</span>
                            </div>

                            <!-- Content -->
                            <div class="relative flex flex-col justify-center items-center space-y-3">
                                <div class="font-medium text-gold/60 text-sm uppercase tracking-wider">Total Votes</div>
                                <div class="font-bold text-gold text-3xl sm:text-4xl lg:text-5xl group-hover:scale-110 transition-all duration-300"
                                    x-text="formatNumber(getTotalVotes())">0</div>
                                <div class="text-gold/40 group-hover:text-gold/60 text-xs transition-all duration-300">and
                                    counting...</div>
                            </div>
                        </div>

                        <!-- Time Remaining -->
                        <div class="group relative col-span-2 sm:col-span-1 hover:shadow-[0_0_50px_0_rgba(255,215,0,0.15)] p-4 sm:p-6 rounded-2xl overflow-hidden hover:scale-[1.02] transition-all duration-500 pageant-card"
                            x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                            <!-- Background Effects -->
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-gold/10 via-gold/5 to-gold/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            </div>
                            <div class="-top-10 -left-10 absolute bg-gold/5 blur-xl rounded-full w-20 h-20 transition-all duration-500"
                                :class="{ 'bg-gold/10 scale-150': isHovered }">
                            </div>
                            <div class="-right-10 -bottom-10 absolute bg-gold/5 blur-xl rounded-full w-20 h-20 transition-all duration-500"
                                :class="{ 'bg-gold/10 scale-150': isHovered }">
                            </div>
                            <!-- Sparkle Effects -->
                            <div class="absolute inset-0 opacity-0 transition-opacity duration-300 pointer-events-none"
                                :class="{ 'opacity-100': isHovered }">
                                <span class="top-1/4 left-1/4 absolute text-gold/30 text-sm">✨</span>
                                <span class="top-3/4 right-1/4 absolute text-gold/30 text-sm">✨</span>
                                <span class="top-1/2 left-3/4 absolute text-gold/30 text-sm">✨</span>
                            </div>

                            <!-- Content -->
                            <div class="relative space-y-3">
                                <div class="font-medium text-gold/60 text-sm text-center uppercase tracking-wider">Time
                                    Remaining</div>
                                <div class="gap-2 sm:gap-3 grid grid-cols-4">
                                    <div class="text-center">
                                        <div
                                            class="relative bg-black/20 group-hover:bg-black/30 backdrop-blur-sm p-2 rounded-lg overflow-hidden transition-all duration-300">
                                            <span
                                                class="bg-clip-text bg-gradient-to-r from-amber-200 to-yellow-500 font-bold text-gold text-transparent text-xl sm:text-2xl lg:text-3xl"
                                                :class="{ 'animate-pulse': pulseStates.days }"
                                                x-text="countdown.days">0</span>
                                            <span class="block font-medium text-gold/60 text-xs">Days</span>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div
                                            class="relative bg-black/20 group-hover:bg-black/30 backdrop-blur-sm p-2 rounded-lg overflow-hidden transition-all duration-300">
                                            <span
                                                class="bg-clip-text bg-gradient-to-r from-amber-200 to-yellow-500 font-bold text-gold text-transparent text-xl sm:text-2xl lg:text-3xl"
                                                :class="{ 'animate-pulse': pulseStates.hours }"
                                                x-text="countdown.hours">0</span>
                                            <span class="block font-medium text-gold/60 text-xs">Hours</span>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div
                                            class="relative bg-black/20 group-hover:bg-black/30 backdrop-blur-sm p-2 rounded-lg overflow-hidden transition-all duration-300">
                                            <span
                                                class="bg-clip-text bg-gradient-to-r from-amber-200 to-yellow-500 font-bold text-gold text-transparent text-xl sm:text-2xl lg:text-3xl"
                                                :class="{ 'animate-pulse': pulseStates.minutes }"
                                                x-text="countdown.minutes">0</span>
                                            <span class="block font-medium text-gold/60 text-xs">Minutes</span>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div
                                            class="relative bg-black/20 group-hover:bg-black/30 backdrop-blur-sm p-2 rounded-lg overflow-hidden transition-all duration-300">
                                            <span
                                                class="bg-clip-text bg-gradient-to-r from-amber-200 to-yellow-500 font-bold text-gold text-transparent text-xl sm:text-2xl lg:text-3xl"
                                                :class="{ 'animate-pulse': pulseStates.seconds }"
                                                x-text="countdown.seconds">0</span>
                                            <span class="block font-medium text-gold/60 text-xs">Seconds</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contestants Count -->
                        <div class="group relative col-span-2 md:col-span-1 hover:shadow-[0_0_50px_0_rgba(255,215,0,0.15)] p-4 sm:p-6 rounded-2xl overflow-hidden hover:scale-[1.02] transition-all duration-500 pageant-card"
                            x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                            <!-- Background Effects -->
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-gold/10 via-gold/5 to-gold/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            </div>
                            <div class="-top-10 -left-10 absolute bg-gold/5 blur-xl rounded-full w-20 h-20 transition-all duration-500"
                                :class="{ 'bg-gold/10 scale-150': isHovered }"></div>
                            <div class="-right-10 -bottom-10 absolute bg-gold/5 blur-xl rounded-full w-20 h-20 transition-all duration-500"
                                :class="{ 'bg-gold/10 scale-150': isHovered }"></div>
                            <!-- Sparkle Effects -->
                            <div class="absolute inset-0 opacity-0 transition-opacity duration-300 pointer-events-none"
                                :class="{ 'opacity-100': isHovered }">
                                <span class="top-1/4 left-1/4 absolute text-gold/30 text-sm">✨</span>
                                <span class="top-3/4 right-1/4 absolute text-gold/30 text-sm">✨</span>
                                <span class="top-1/2 left-3/4 absolute text-gold/30 text-sm">✨</span>
                            </div>

                            <!-- Content -->
                            <div class="relative flex flex-col justify-center items-center space-y-3">
                                <div class="font-medium text-gold/60 text-sm uppercase tracking-wider">Contestants</div>
                                <div class="relative">
                                    <div
                                        class="bg-clip-text bg-gradient-to-r from-amber-200 to-yellow-500 font-bold text-gold text-transparent text-3xl sm:text-4xl lg:text-5xl group-hover:scale-110 transition-all duration-300">
                                        {{ $event->contestants->count() }}</div>
                                    <div
                                        class="top-0 -right-3 absolute text-gold/40 group-hover:text-gold/60 text-lg group-hover:rotate-12 group-hover:scale-110 transition-all duration-300">
                                        ✨</div>
                                </div>
                                <div class="text-gold/40 group-hover:text-gold/60 text-xs transition-all duration-300">
                                    beautiful contestants</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Title Holders Section -->
                <div class="mb-16">
                    <!-- Section Title with Crown Animation -->
                    <div class="relative mb-12 text-center">
                        <div class="top-1/2 left-1/2 absolute -translate-x-1/2 -translate-y-1/2">
                            <div
                                class="bg-gradient-to-r from-gold/20 via-transparent to-gold/20 blur-xl rounded-full w-32 h-32 animate-spin-slow">
                            </div>
                        </div>
                        <h2 class="inline-block relative font-playfair font-bold text-gold text-3xl sm:text-4xl">
                            <span class="top-1/2 -left-8 absolute -translate-y-1/2">
                                <span class="inline-block text-3xl animate-float">⭐</span>
                            </span>
                            Leading Contestants
                            <span class="top-1/2 -right-8 absolute -translate-y-1/2">
                                <span class="inline-block text-3xl animate-float" style="animation-delay: 0.5s">⭐</span>
                            </span>
                        </h2>
                        <p class="mt-4 text-gold/60">Vote for your favorite contestant and help them win the crown!</p>
                    </div>

                    <!-- Title Holders Grid -->
                    <div class="gap-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($event->contestants->where('is_featured', true)->take(3) as $index => $contestant)
                            <!-- Title Holder Card -->
                            <a href="{{ route('vote.show', $contestant['id']) }}" class="block">
                                <div class="group relative transform-gpu hover:scale-[1.02] transition-all duration-500">
                                    <!-- Rank Badge -->
                                    <div class="-top-4 -right-4 z-20 absolute">
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
                                        <div class="relative animate-float">
                                            <!-- Glowing Effect -->
                                            <div
                                                class="absolute inset-0 animate-pulse rounded-full bg-gradient-to-br {{ $style['bg'] }} opacity-50 blur-xl">
                                            </div>
                                            <!-- Badge Container -->
                                            <div
                                                class="relative flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br {{ $style['bg'] }} p-1">
                                                <div
                                                    class="flex justify-center items-center bg-black/50 backdrop-blur-sm rounded-full w-full h-full">
                                                    <span class="text-2xl">{{ $style['icon'] }}</span>
                                                </div>
                                            </div>
                                            <!-- Rank Number -->
                                            <div
                                                class="-bottom-2 left-1/2 absolute bg-black/50 backdrop-blur-sm px-2 py-0.5 rounded-full font-bold text-gold text-xs -translate-x-1/2">
                                                #{{ $index + 1 }}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Card Content -->
                                    <div
                                        class="group relative bg-gradient-to-b from-black/40 to-black/60 shadow-lg backdrop-blur-sm rounded-xl overflow-hidden transition-all duration-300">
                                        <!-- Background Effects -->
                                        <div
                                            class="-top-20 -left-20 absolute bg-gold/20 group-hover:bg-gold/30 blur-3xl rounded-full w-40 h-40 transition-all duration-500">
                                        </div>
                                        <div
                                            class="-right-20 -bottom-20 absolute bg-gold/20 group-hover:bg-gold/30 blur-3xl rounded-full w-40 h-40 transition-all duration-500">
                                        </div>

                                        <!-- Image Section -->
                                        <div class="relative aspect-[3/4] overflow-hidden">
                                            <img src="{{ \Storage::url($contestant['image_url']) }}" loading="lazy"
                                                alt="{{ $contestant['name'] }}"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                                            <!-- Gradient Overlay -->
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent opacity-90">
                                            </div>

                                            <!-- Content Overlay -->
                                            <div class="right-0 bottom-0 left-0 absolute p-6 text-center">
                                                <!-- Name and Title -->
                                                <div class="mb-4">
                                                    <div class="flex justify-center items-center gap-2 mb-1">
                                                        <img src="https://flagcdn.com/w40/{{ strtolower($contestant['country_code']) }}.png"
                                                            alt="{{ $contestant['country'] }} flag"
                                                            class="shadow-lg rounded w-7 h-5">
                                                    </div>
                                                    <h3 class="mb-2 font-playfair font-bold text-white text-2xl">
                                                        {{ $contestant['name'] }}</h3>
                                                    <p class="font-medium text-gold text-lg">Currently
                                                        #{{ $index + 1 }}
                                                    </p>
                                                    <p class="text-gold/80 text-sm">{{ $contestant['title'] }}</p>
                                                </div>

                                                <!-- Vote Stats -->
                                                <div class="bg-black/30 backdrop-blur-sm mb-4 p-3 rounded-lg">
                                                    <div class="flex justify-between items-center mb-2">
                                                        <span class="text-gold/60 text-sm">Total Votes</span>
                                                        <span class="font-bold text-gold"
                                                            x-text="formatNumber(votes[{{ $contestant['id'] }}])">0</span>
                                                    </div>
                                                    <div class="relative bg-black/30 rounded-full h-2 overflow-hidden">
                                                        <div class="absolute inset-0 bg-gradient-to-r {{ $style['bg'] }}"
                                                            :style="'width: ' + getVotePercentage({{ $contestant['id'] }}) +
                                                                '%'"
                                                            style="transition: width 1s ease-in-out"></div>
                                                    </div>
                                                    <div class="mt-1 text-right">
                                                        <span class="text-gold/60 text-xs"
                                                            x-text="getVotePercentage({{ $contestant['id'] }}) + '%'">0%</span>
                                                    </div>
                                                </div>
                                                <span x-text="can_vote"></span>
                                                <span x-text="loading"></span>

                                                <!-- Vote Button -->
                                                
                                                <button @click.prevent="castVote({{ $contestant['id'] }})"
                                                    :disabled="!can_vote || loading"
                                                    :id="'vote-button-' + {{ $contestant['id'] }}"
                                                    class="group relative w-full overflow-hidden rounded-full bg-gradient-to-r {{ $style['bg'] }} p-[2px] transition-all duration-300 hover:scale-105 hover:shadow-[0_0_2rem_0_rgba(255,215,0,0.3)]"
                                                    :class="{
                                                        'cursor-not-allowed opacity-50': !can_vote || loading,
                                                    }"
                                                    >
                                                    <div
                                                        class="relative flex justify-center items-center gap-2 bg-black/50 group-hover:bg-opacity-90 backdrop-blur-sm px-6 py-2 rounded-full w-full h-full transition-all duration-300">
                                                        <span class="text-white">Vote Now</span>
                                                        <span class="text-lg">{{ $style['icon'] }}</span>
                                                    </div>
                                                </button>
                                                {{-- share button --}}
                                                <button @click.prevent='activeShare = @json($contestant)'
                                                    class="flex justify-center items-center space-x-2 mt-3 w-full text-gold hover:text-gold/80 text-sm transition">
                                                    <svg class="w-4 h-4 text-gold" fill="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.02-4.11a3 3 0 1 0-.91-1.45L8.09 9.85a3 3 0 1 0 0 4.3l7.1 4.16A3 3 0 1 0 18 16.08z" />
                                                    </svg>
                                                    <span>Share</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>


                <!-- Other Contestants -->
                <h2 class="mb-6 font-playfair font-bold text-gold text-2xl text-center">National Title Holders</h2>
                <div class="gap-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($event->contestants->where('is_featured', false) as $index => $contestant)
                        <div class="group pageant-card"
                            :class="{ 'animate-glow': loading && selectedContestant === {{ $index + 1 }} }">
                            <a href="{{ route('vote.show', $contestant['id']) }}" class="block">
                                <div class="relative overflow-hidden">
                                    <img src="{{ \Storage::url($contestant['image_url']) }}"
                                        alt="{{ $contestant['name'] }}" loading="lazy"
                                        class="w-full h-80 object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>
                                    <div
                                        class="right-0 bottom-0 left-0 absolute p-6 transition-transform translate-y-full group-hover:translate-y-0 duration-300">
                                        <div class="flex items-center gap-2 mb-2">
                                            <img src="https://flagcdn.com/w40/{{ strtolower($contestant['country_code']) }}.png"
                                                alt="{{ $contestant['country'] }} flag" class="shadow rounded w-6 h-4">
                                            <h3 class="font-playfair font-bold text-gold text-2xl">
                                                {{ $contestant['name'] }}</h3>
                                        </div>
                                        <p class="mb-1 text-gold/80">{{ $contestant['title'] }}</p>
                                        <p class="text-white/70 text-sm">Focus: {{ $contestant['focus_area'] }}</p>
                                        <div class="flex gap-2 mt-3">
                                            <span class="bg-gold/10 px-2 py-1 rounded-full text-gold/90 text-xs">PETCH
                                                Ambassador</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-6">
                                    <div class="mb-4">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-gold/60">Current Votes</span>
                                            <span class="vote-count"
                                                x-text="formatNumber(votes[{{ $contestant['id'] }}])"></span>
                                        </div>
                                        <div class="progress-bar">
                                            <div :id="'progress-' + {{ $contestant['id'] }}" class="progress-bar-fill"
                                                :style="'width: ' + getVotePercentage({{ $contestant['id'] }}) + '%'">
                                            </div>
                                        </div>
                                        <div class="mt-1 text-right">
                                            <span class="text-gold/60 text-sm"
                                                x-text="getVotePercentage({{ $contestant['id'] }}) + '%'"></span>
                                        </div>
                                    </div>

                                    <button :id="'vote-button-' + {{ $contestant['id'] }}"
                                        :disabled="!can_vote || loading"
                                        @click.prevent="castVote({{ $contestant['id'] }}); selectedContestant = {{ $index + 1 }}"
                                        class="flex justify-center items-center space-x-2 disabled:opacity-50 w-full disabled:cursor-not-allowed vote-button">
                                        <span>Vote Now</span>
                                        <span class="text-lg">👑</span>
                                    </button>
                                    {{-- share button --}}
                                    <button @click.prevent='activeShare = @json($contestant)'
                                        class="flex justify-center items-center space-x-2 mt-3 w-full text-gold hover:text-gold/80 text-sm transition">
                                        <svg class="w-4 h-4 text-gold" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.02-4.11a3 3 0 1 0-.91-1.45L8.09 9.85a3 3 0 1 0 0 4.3l7.1 4.16A3 3 0 1 0 18 16.08z" />
                                        </svg>
                                        <span>Share</span>
                                    </button>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    @else
        <div class="flex justify-center items-center h-screen">
            <div class="text-center">
                <h1 class="font-bold text-gold text-4xl">Voting is not started yet!</h1>
            </div>
        </div>
    @endif

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('votingData', () => ({
                    totalVotes: 500,
                    showDetailModal: false,
                    selectedContestant: null,
                    contestants: @json($event?->contestants),
                    showContestantDetail(contestantData) {
                        this.selectedContestant = JSON.parse(contestantData);
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
