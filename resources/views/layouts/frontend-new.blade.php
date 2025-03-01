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
                        <img src="https://heritagepageant.com/wp-content/uploads/2023/06/logo-1-68x65.png"
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
                    <a href="/events" class="nav-link-hover group px-4 py-2">
                        <span class="relative">
                            <span
                                class="bg-gold absolute inset-x-0 -bottom-1 h-0.5 origin-left scale-x-0 transform transition-transform duration-300 group-hover:scale-x-100"></span>
                            <span
                                class="group-hover:text-gold relative text-gray-300 transition-colors duration-300">Events</span>
                        </span>
                    </a>
                    <a href="/vote" class="nav-button group relative px-6 py-2">
                        <span class="from-gold/20 to-gold/0 absolute inset-0 rounded-full bg-gradient-to-r"></span>
                        <span class="text-gold relative font-medium">Vote Now</span>
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
                    <a href="/events" class="hover:text-gold block px-3 py-2 text-gray-300">Events</a>
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

    <!-- Footer -->
    <footer class="border-gold/20 relative mt-32 border-t backdrop-blur-lg">
        <!-- Decorative Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="bg-gold/5 absolute -left-1/4 -top-1/4 h-96 w-96 rounded-full blur-3xl"></div>
            <div class="bg-gold/5 absolute -bottom-1/4 -right-1/4 h-96 w-96 rounded-full blur-3xl"></div>
        </div>

        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <!-- Brand Section -->
                <div class="space-y-8 xl:col-span-1">
                    <div class="flex items-center space-x-3">
                        <img src="https://heritagepageant.com/wp-content/uploads/2023/06/logo-1-68x65.png"
                            alt="Heritage Pageants Logo" class="h-10 w-auto">
                        <div class="font-playfair text-gold text-lg font-bold">Heritage Pageants</div>
                    </div>
                    <p class="text-sm text-gray-400">
                        Celebrating beauty, culture, and heritage through international pageantry. Join us in our
                        mission to promote peace, environment, tourism, and cultural exchange.
                    </p>
                    <div class="flex space-x-6">
                        <a href="#" class="hover:text-gold text-gray-400">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
                            </svg>
                        </a>
                        <a href="#" class="hover:text-gold text-gray-400">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" />
                            </svg>
                        </a>
                        <a href="#" class="hover:text-gold text-gray-400">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="mt-12 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="font-playfair text-gold text-sm font-semibold uppercase tracking-wider">Quick
                                Links</h3>
                            <ul class="mt-4 space-y-4">
                                <li><a href="/" class="hover:text-gold text-sm text-gray-400">Home</a></li>
                                <li><a href="/gallery" class="hover:text-gold text-sm text-gray-400">Gallery</a></li>
                                <li><a href="/events" class="hover:text-gold text-sm text-gray-400">Events</a></li>
                                <li><a href="/vote" class="hover:text-gold text-sm text-gray-400">Vote</a></li>
                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="font-playfair text-gold text-sm font-semibold uppercase tracking-wider">Support
                            </h3>
                            <ul class="mt-4 space-y-4">
                                <li><a href="/contact" class="hover:text-gold text-sm text-gray-400">Contact</a></li>
                                <li><a href="#" class="hover:text-gold text-sm text-gray-400">Privacy Policy</a>
                                </li>
                                <li><a href="#" class="hover:text-gold text-sm text-gray-400">Terms &
                                        Conditions</a></li>
                                <li><a href="#" class="hover:text-gold text-sm text-gray-400">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-gold/20 mt-12 border-t pt-8">
                <p class="text-center text-sm text-gray-400">&copy; {{ date('Y') }} Heritage Pageants. All rights
                    reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>
