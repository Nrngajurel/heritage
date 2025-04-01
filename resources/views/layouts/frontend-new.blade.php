<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Miss Heritage International 2025 - Heritage Pageants</title>

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
    @livewireStyles
    <wireui:scripts />
    @vite(['resources/css/app.css', 'resources/css/pageant.css', 'resources/js/app.js'])

</head>


<body class="min-h-screen bg-gray-900 text-gray-100 antialiased" x-data="{ mobileMenu: false }">


    <!-- Navigation -->
    <nav class="border-gold/20 fixed z-50 w-full backdrop-blur-lg transition-all duration-300"
        :class="{ 'shadow-lg shadow-gold/5': window.pageYOffset > 0 }"
        @scroll.window="document.documentElement.style.setProperty('--scroll-y', `${window.pageYOffset}px`)">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-20 items-center justify-between">
                <!-- Logo Section -->
                <div class="flex items-center space-x-4">
                    <a href="/" class="logo-glow group flex items-center space-x-3">
                        <img src="/logo.png"
                            alt="Heritage Pageants Logo"
                            class="h-12 w-auto transition-transform duration-300 group-hover:scale-110">
                        <div>
                            <div class="font-playfair text-gold text-xl font-bold">Heritage Pageants</div>
                            <div class="text-gold/60 text-xs">International Beauty Pageant</div>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden sm:flex sm:items-center sm:space-x-1">
                    <a href="/" class="nav-link-hover group px-4 py-2">
                        <span class="relative">
                            <span
                                class="bg-gold absolute inset-x-0 -bottom-1 h-0.5 origin-left scale-x-0 transform transition-transform duration-300 group-hover:scale-x-100"></span>
                            <span
                                class="group-hover:text-gold relative text-gray-300 transition-colors duration-300">Home</span>
                        </span>
                    </a>
                    <a href="/gallery" class="nav-link-hover group px-4 py-2">
                        <span class="relative">
                            <span
                                class="bg-gold absolute inset-x-0 -bottom-1 h-0.5 origin-left scale-x-0 transform transition-transform duration-300 group-hover:scale-x-100"></span>
                            <span
                                class="group-hover:text-gold relative text-gray-300 transition-colors duration-300">Gallery</span>
                        </span>
                    </a>
                    
                    <!-- Events Dropdown -->
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="nav-link-hover group px-4 py-2">
                            <span class="relative inline-flex items-center">
                                <span class="bg-gold absolute inset-x-0 -bottom-1 h-0.5 origin-left scale-x-0 transform transition-transform duration-300 group-hover:scale-x-100"></span>
                                <span class="group-hover:text-gold relative text-gray-300 transition-colors duration-300">Events</span>
                                <svg class="group-hover:text-gold ml-1 h-4 w-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-1"
                             class="absolute left-0 mt-2 w-64 rounded-md bg-gray-900 py-2 shadow-xl">
                            @foreach($events as $event)
                                <a href="{{ route('events.show', $event->id) }}" 
                                   class="hover:bg-gold/10 hover:text-gold block px-4 py-3 text-sm text-gray-300">
                                    {{ $event->name }}
                                </a>
                                @unless($loop->last)
                                    <div class="my-0.5 border-t border-gray-700"></div>
                                @endunless
                            @endforeach
                           
                        </div>
                    </div>

                    <a href="/vote" class="nav-button group relative px-6 py-2">
                        <span class="from-gold/20 to-gold/0 absolute inset-0 rounded-full bg-gradient-to-r"></span>
                        <span class="text-gold relative font-medium">Vote Now</span>
                    </a>
                    <a href="/apply" class="nav-button group relative px-6 py-2">
                        <span class="from-gold/20 to-gold/0 absolute inset-0 rounded-full bg-gradient-to-r"></span>
                        <span class="text-gold relative font-medium">Apply Now</span>
                    </a>
                    <a href="/contact" class="nav-link-hover group px-4 py-2">
                        <span class="relative">
                            <span
                                class="bg-gold absolute inset-x-0 -bottom-1 h-0.5 origin-left scale-x-0 transform transition-transform duration-300 group-hover:scale-x-100"></span>
                            <span
                                class="group-hover:text-gold relative text-gray-300 transition-colors duration-300">Contact</span>
                        </span>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center sm:hidden">
                    <button type="button" class="text-gold" @click="mobileMenu = !mobileMenu">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <!-- Mobile Menu -->
            <div class="sm:hidden" x-show="mobileMenu" x-transition>
                <div class="space-y-1 pb-3 pt-2">
                    <a href="/" class="hover:text-gold block px-3 py-2 text-gray-300">Home</a>
                    <a href="/gallery" class="hover:text-gold block px-3 py-2 text-gray-300">Gallery</a>
                    
                    <!-- Mobile Events Dropdown -->
                    <div x-data="{ open: false }">
                        <button @click="open = !open" class="hover:text-gold flex w-full items-center justify-between px-3 py-2 text-gray-300">
                            <span>Events</span>
                            <svg class="h-4 w-4" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" class="pl-4">
                            @foreach($events as $event)
                                <a href="{{ route('events.show', $event->id) }}" 
                                   class="hover:text-gold block px-3 py-2 text-sm text-gray-300">
                                    {{ $event->name }}
                                </a>
                                @unless($loop->last)
                                    <div class="my-0.5 border-t border-gray-700"></div>
                                @endunless
                            @endforeach
                            
                        </div>
                    </div>

                    <a href="/vote" class="text-gold block px-3 py-2 font-medium">Vote Now</a>
                    <a href="/contact" class="hover:text-gold block px-3 py-2 text-gray-300">Contact</a>
                </div>
            </div>
        </div>
    </nav>



    @yield('content')

    @stack('scripts')



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
    @livewireScripts
</body>

</html>
