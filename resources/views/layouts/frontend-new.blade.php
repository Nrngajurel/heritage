<!DOCTYPE html class="dark">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Miss Heritage International') - Heritage Pageants</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <style>
        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        @keyframes glow {

            0%,
            100% {
                opacity: 0.5;
            }

            50% {
                opacity: 1;
            }
        }

        .nav-link-hover::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #FFD700, transparent);
            transform: scaleX(0);
            transform-origin: center;
            transition: transform 0.3s ease;
        }

        .nav-link-hover:hover::after {
            transform: scaleX(1);
        }

        .nav-active {
            position: relative;
            color: #FFD700;
        }

        .nav-active::before {
            content: '';
            position: absolute;
            top: 50%;
            left: -10px;
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background-color: #FFD700;
            transform: translateY(-50%);
        }

        .logo-glow {
            position: relative;
            overflow: hidden;
        }

        .logo-glow::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 215, 0, 0.1) 0%, transparent 70%);
            animation: glow 3s infinite;
        }

        .nav-button {
            position: relative;
            overflow: hidden;
        }

        .nav-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 215, 0, 0.2), transparent);
            animation: shimmer 2s infinite;
        }
    </style>
    @stack('styles')

    @if (!request()->is('application-form'))
        @vite(['resources/css/app.css', 'resources/css/pageant.css', 'resources/js/app.js'])
    @else
        @vite(['resources/css/app.css', 'resources/css/pageant.css'])
    @endif

</head>


<body class="bg-gray-900 min-h-screen text-gray-100 antialiased" x-data="{ mobileMenu: false }" x-cloak>


    <!-- Navigation -->
    <nav class="z-50 fixed backdrop-blur-lg border-gold/20 w-full transition-all duration-300"
        :class="{ 'shadow-lg shadow-gold/5': window.pageYOffset > 0 }"
        @scroll.window="document.documentElement.style.setProperty('--scroll-y', `${window.pageYOffset}px`)">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <div class="flex justify-between items-center h-20">
                <!-- Logo Section -->
                <div class="flex items-center space-x-4">
                    <a href="/" class="group flex items-center space-x-3 logo-glow">
                        <img src="/logo.png" alt="Heritage Pageants Logo"
                            class="w-auto h-12 group-hover:scale-110 transition-transform duration-300">
                        <div>
                            <div class="font-playfair font-bold text-gold text-xl">Heritage Pageants</div>
                            <div class="text-gold/60 text-xs">International Beauty Pageant</div>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden sm:flex sm:items-center sm:space-x-1">
                    <a href="{{ route('home') }}" class="group px-4 py-2 nav-link-hover">
                        <span class="relative">
                            <span
                                class="-bottom-1 absolute inset-x-0 bg-gold h-0.5 scale-x-0 group-hover:scale-x-100 origin-left transition-transform duration-300 transform"></span>
                            <span
                                class="relative text-gray-300 group-hover:text-gold transition-colors duration-300">Home</span>
                        </span>
                    </a>


                    <!-- Events Dropdown -->
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="group px-4 py-2 nav-link-hover">
                            <span class="inline-flex relative items-center">
                                <span
                                    class="-bottom-1 absolute inset-x-0 bg-gold h-0.5 scale-x-0 group-hover:scale-x-100 origin-left transition-transform duration-300 transform"></span>
                                <span
                                    class="relative text-gray-300 group-hover:text-gold transition-colors duration-300">Events</span>
                                <svg class="ml-1 w-4 h-4 text-gray-300 group-hover:text-gold" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="left-0 absolute bg-gray-900 shadow-xl mt-2 py-2 rounded-md w-64">
                            <div class="max-h-96 overflow-y-auto">
                                @foreach ($events as $event)
                                    <a href="{{ route('events.show', $event->id) }}"
                                        class="block hover:bg-gold/10 px-4 py-3 text-gray-300 hover:text-gold text-sm">
                                        {{ $event->name }}
                                    </a>
                                    @unless ($loop->last)
                                        <div class="my-0.5 border-gray-700 border-t"></div>
                                    @endunless
                                @endforeach
                            </div>

                        </div>
                    </div>

                    <a href="{{ route('gallery') }}" class="group px-4 py-2 nav-link-hover">
                        <span class="relative">
                            <span
                                class="-bottom-1 absolute inset-x-0 bg-gold h-0.5 scale-x-0 group-hover:scale-x-100 origin-left transition-transform duration-300 transform"></span>
                            <span
                                class="relative text-gray-300 group-hover:text-gold transition-colors duration-300">Gallery</span>
                        </span>
                    </a>


                    <a href="{{ route('team') }}" class="group px-4 py-2 nav-link-hover">
                        <span class="relative">
                            <span
                                class="relative text-gray-300 group-hover:text-gold transition-colors duration-300">Team</span>
                        </span>
                    </a>
                    <a href="{{ route('newApplicationForm') }}" class="group relative px-6 py-2 nav-button">
                        <span class="absolute inset-0 bg-gradient-to-r from-gold/20 to-gold/0 rounded-full"></span>
                        <span class="relative font-medium text-gold">Apply Now</span>
                    </a>

                    {{-- <a href="{{ asset('heritage_pageants_2025.pdf') }}" target="_blank"
                        class="group px-4 py-2 nav-link-hover">
                        <span class="relative">
                            <span
                                class="relative text-gray-300 group-hover:text-gold transition-colors duration-300">MHI
                                2025</span>
                        </span>
                    </a> --}}

                    <!-- MHI Dropdown -->
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="group px-4 py-2 nav-link-hover">
                            <span class="inline-flex relative items-center">
                                <span
                                    class="-bottom-1 absolute inset-x-0 bg-gold h-0.5 scale-x-0 group-hover:scale-x-100 origin-left transition-transform duration-300 transform"></span>
                                <span
                                    class="relative text-gray-300 group-hover:text-gold transition-colors duration-300">
                                    MHI {{ date('Y') }}
                                </span>
                                <svg class="ml-1 w-4 h-4 text-gray-300 group-hover:text-gold"
                                    :class="{ 'rotate-180': open }" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="left-0 absolute bg-gray-900 shadow-xl mt-2 py-2 rounded-md w-64">

                            <div class="max-h-96 overflow-y-auto">
                                <a target="_blank"
                                    href="{{ asset('Heritage Pageants 2026_National Director (1).pdf') }}"
                                    class="block hover:bg-gold/10 px-4 py-3 text-gray-300 hover:text-gold text-sm">
                                    National Director Overview 2026
                                </a>

                                <div class="my-0.5 border-gray-700 border-t"></div>

                                <a target="_blank" href="{{ asset('Heritage Pageants 2026_ND_Franchise (1).pdf') }}"
                                    class="block hover:bg-gold/10 px-4 py-3 text-gray-300 hover:text-gold text-sm">
                                    National Director Franchise Guide 2026
                                </a>
                            </div>
                        </div>
                    </div>




                    <a href="/contact" class="group px-4 py-2 nav-link-hover">
                        <span class="relative">
                            <span
                                class="-bottom-1 absolute inset-x-0 bg-gold h-0.5 scale-x-0 group-hover:scale-x-100 origin-left transition-transform duration-300 transform"></span>
                            <span
                                class="relative text-gray-300 group-hover:text-gold transition-colors duration-300">Contact</span>
                        </span>
                    </a>
                    <a href="{{ route('vote.index') }}" class="group relative px-6 py-2 nav-button">
                        <span class="absolute inset-0 bg-gradient-to-r from-gold/20 to-gold/0 rounded-full"></span>
                        <span class="relative font-medium text-gold">Vote Now</span>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="sm:hidden flex items-center">
                    <button type="button" class="text-gold" @click="mobileMenu = !mobileMenu">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <!-- Mobile Menu -->
            <div class="sm:hidden" x-show="mobileMenu" x-transition>
                <div class="space-y-1 pt-2 pb-3 overflow-auto">
                    <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-300 hover:text-gold">Home</a>

                    <!-- Mobile Events Dropdown -->
                    <div x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex justify-between items-center px-3 py-2 w-full text-gray-300 hover:text-gold">
                            <span>Events</span>
                            <svg class="w-4 h-4" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" class="pl-4 max-h-60 overflow-auto">
                            @foreach ($events as $event)
                                <a href="{{ route('events.show', $event->id) }}"
                                    class="block px-3 py-2 text-gray-300 hover:text-gold text-sm">
                                    {{ $event->name }}
                                </a>
                                @unless ($loop->last)
                                    <div class="my-0.5 border-gray-700 border-t"></div>
                                @endunless
                            @endforeach
                        </div>
                    </div>

                    <a href="{{ route('gallery') }}"
                        class="block px-3 py-2 text-gray-300 hover:text-gold">Gallery</a>
                    <a href="{{ route('team') }}" class="block px-3 py-2 text-gray-300 hover:text-gold">Team</a>
                    <a href="{{ route('newApplicationForm') }}" class="block px-3 py-2 font-medium text-gold">Apply
                        Now</a>
                    {{-- <a href="{{ asset('heritage_pageants_2025.pdf') }}" target="_blank"
                        class="block px-3 py-2 text-gray-300 hover:text-gold">MHI 2025</a> --}}
                    <div x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex justify-between items-center px-3 py-2 w-full text-gray-300 hover:text-gold">
                            <span>MHI {{ date('Y') }}</span>
                            <svg class="w-4 h-4" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" class="pl-4 max-h-60 overflow-auto">

                            <a href="{{ asset('Heritage Pageants 2026_National Director (1).pdf') }}"
                                class="block px-3 py-2 text-gray-300 hover:text-gold text-sm">
                                National Director Overview 2026
                            </a>
                            <div class="my-0.5 border-gray-700 border-t"></div>
                            <a href="{{ asset('Heritage Pageants 2026_ND_Franchise (1).pdf') }}"
                                class="block px-3 py-2 text-gray-300 hover:text-gold text-sm">
                                National Director Franchise Guide 2026
                            </a>
                        </div>
                    </div>
                    <a href="/contact" class="block px-3 py-2 text-gray-300 hover:text-gold">Contact</a>
                    <a href="{{ route('vote.index') }}" class="block px-3 py-2 font-medium text-gold">Vote Now</a>
                </div>
            </div>
        </div>
    </nav>



    @yield('content')



    <script>
        function timer(expiry) {
            return {
                expiry: expiry,
                remaining: null,
                init() {
                    this.setRemaining()
                    setInterval(() => {
                        this.setRemaining();
                    }, 1000);
                },
                setRemaining() {
                    const diff = this.expiry - new Date().getTime();
                    this.remaining = parseInt(diff / 1000);
                },
                days() {
                    return {
                        value: this.remaining / 86400,
                        remaining: this.remaining % 86400
                    };
                },
                hours() {
                    return {
                        value: this.days().remaining / 3600,
                        remaining: this.days().remaining % 3600
                    };
                },
                minutes() {
                    return {
                        value: this.hours().remaining / 60,
                        remaining: this.hours().remaining % 60
                    };
                },
                seconds() {
                    return {
                        value: this.minutes().remaining,
                    };
                },
                format(value) {
                    return ("0" + parseInt(value)).slice(-2)
                },
                time() {
                    return {
                        days: this.format(this.days().value),
                        hours: this.format(this.hours().value),
                        minutes: this.format(this.minutes().value),
                        seconds: this.format(this.seconds().value),
                    }
                },
            }
        }
    </script>

    @include('layouts.partials.footer')
    @stack('scripts')
</body>

</html>
