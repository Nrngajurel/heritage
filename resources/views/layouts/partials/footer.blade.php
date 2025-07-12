    <!-- Footer -->
    <footer class="border-gold/20 relative mt-32 border-t backdrop-blur-lg">
        <!-- Decorative Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="bg-gold/5 absolute -left-1/4 -top-1/4 h-96 w-96 rounded-full blur-3xl"></div>
            <div class="bg-gold/5 absolute -bottom-1/4 -right-1/4 h-96 w-96 rounded-full blur-3xl"></div>
        </div>

        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="xl:grid xl:grid-cols-5 xl:gap-8">
                <!-- About Us Section -->
                <div class="col-span-2 space-y-8">
                    <div class="flex items-center space-x-3">
                        <img src="/logo.png" alt="Heritage Pageants Logo" class="h-10 w-auto">
                        <div class="font-playfair text-gold text-lg font-bold">{{ setting()->site_name }}</div>
                    </div>
                    <p class="text-sm text-gray-400">
                        {{ setting()->site_description }}
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="mt-12 xl:mt-0">
                    <h3 class="font-playfair text-gold text-sm font-semibold uppercase tracking-wider">Our Services</h3>
                    <ul class="mt-4 space-y-4">
                        <li><a href="/" class="hover:text-gold text-sm text-gray-400">Home</a></li>
                        <li><a href="/privacy-policy" class="hover:text-gold text-sm text-gray-400">Privacy</a></li>
                        <li><a href="/biography" class="hover:text-gold text-sm text-gray-400">Biography</a></li>
                        <li><a href="/terms" class="hover:text-gold text-sm text-gray-400">Terms and Conditions</a>
                        </li>
                        <li><a href="/contact" class="hover:text-gold text-sm text-gray-400">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact Information -->
                <div class="mt-12 xl:mt-0">
                    <h3 class="font-playfair text-gold text-sm font-semibold uppercase tracking-wider">Contact Us</h3>
                    <div class="mt-6 grid grid-cols-1 gap-6">
                        <!-- Office Locations -->
                        <div class="space-y-4">
                            <div class="space-y-3">
                                <div class="flex items-center space-x-3 text-sm text-gray-400">
                                    <svg class="text-gold/60 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <span>{{ setting()->phone }}</span>
                                </div>
                                <div class="flex items-center space-x-3 text-sm text-gray-400">
                                    <svg class="text-gold/60 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ setting()->email }}</span>
                                </div>
                                <div class="flex items-start space-x-3 text-sm text-gray-400">
                                    <svg class="text-gold/60 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>{!! nl2br(setting()->address) !!}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex space-x-6">
                        @foreach (setting()->social_links as $link)
                            @if (isset($link['url']) && $link['url'])
                                <a href="{{ $link['url'] }}" class="hover:text-gold pr-2 text-gray-400" target="_blank"
                                    rel="noopener noreferrer">
                                    <span class="sr-only">{{ ucfirst($link['platform']) }}</span>
                                    @if ($link['platform'] == 'facebook')
                                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
                                        </svg>
                                    @elseif($link['platform'] == 'instagram')
                                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.398.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" />
                                        </svg>
                                    @elseif($link['platform'] == 'twitter')
                                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                        </svg>
                                    @elseif($link['platform'] == 'linkedin')
                                        <svg class="h-6 w-6" version="1.1" id="Layer_1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 382 382"
                                            xml:space="preserve">
                                            <path fill="currentColor" d="M347.445,0H34.555C15.471,0,0,15.471,0,34.555v312.889C0,366.529,15.471,382,34.555,382h312.889
                                   C366.529,382,382,366.529,382,347.444V34.555C382,15.471,366.529,0,347.445,0z M118.207,329.844c0,5.554-4.502,10.056-10.056,10.056
                                   H65.345c-5.554,0-10.056-4.502-10.056-10.056V150.403c0-5.554,4.502-10.056,10.056-10.056h42.806
                                   c5.554,0,10.056,4.502,10.056,10.056V329.844z M86.748,123.432c-22.459,0-40.666-18.207-40.666-40.666S64.289,42.1,86.748,42.1
                                   s40.666,18.207,40.666,40.666S109.208,123.432,86.748,123.432z M341.91,330.654c0,5.106-4.14,9.246-9.246,9.246H286.73
                                   c-5.106,0-9.246-4.14-9.246-9.246v-84.168c0-12.556,3.683-55.021-32.813-55.021c-28.309,0-34.051,29.066-35.204,42.11v97.079
                                   c0,5.106-4.139,9.246-9.246,9.246h-44.426c-5.106,0-9.246-4.14-9.246-9.246V149.593c0-5.106,4.14-9.246,9.246-9.246h44.426
                                   c5.106,0,9.246,4.14,9.246,9.246v15.655c10.497-15.753,26.097-27.912,59.312-27.912c73.552,0,73.131,68.716,73.131,106.472
                                   L341.91,330.654L341.91,330.654z" />
                                        </svg>
                                    @endif
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Facebook Feed -->
                <div class="mt-12 xl:mt-0">
                    <iframe name="f47feba4b8e50ef63" width="300" height="400"
                        data-testid="fb:page Facebook Social Plugin" title="fb:page Facebook Social Plugin"
                        frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no"
                        allow="encrypted-media"
                        src="https://www.facebook.com/v18.0/plugins/page.php?adapt_container_width=true&amp;app_id=448669870225600&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Dfb133308fe1764147%26domain%3Dheritagepageant.com%26is_canvas%3Dfalse%26origin%3Dhttps%253A%252F%252Fheritagepageant.com%252Ff3bec6ac9aff8b4b5%26relation%3Dparent.parent&amp;container_width=503&amp;hide_cover=false&amp;href=https%3A%2F%2Fwww.facebook.com%2Fpageantofheritage&amp;locale=en_US&amp;sdk=joey&amp;show_facepile=true&amp;small_header=false&amp;tabs=timeline&amp;width="
                        class="w-full" loading="lazy">
                    </iframe>
                </div>
            </div>

            <!-- Visitor Counter -->
            <div class="relative mx-auto max-w-7xl px-4">
                <div class="flex items-center justify-center">
                    <div class="group relative overflow-hidden rounded-2xl bg-black/40 p-6 backdrop-blur-sm transition-all duration-500"
                        id="visitor-counter">
                        <div
                            class="from-gold/10 absolute inset-0 bg-gradient-to-r to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100">
                        </div>
                        <div class="relative z-10 flex items-center space-x-4">
                            <div class="bg-gold/10 flex h-12 w-12 items-center justify-center rounded-full">
                                <svg class="text-gold h-6 w-6" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div class="text-center">
                                <p class="mb-3 text-sm text-gray-400">Total Visitors</p>

                                <p class="font-playfair text-gold text-2xl font-bold" id="counter"
                                    data-number="{{ setting()->visitor_count }}">
                                    @foreach (str_split(setting()->visitor_count) as $digit)
                                        <span class="inline-block rounded bg-blue-500 px-1">{{ $digit }}</span>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-gold/20 mt-12 border-t pt-8">
                <p class="text-center text-sm text-gray-400">{{ setting()->footer_text }}</p>
            </div>
        </div>
    </footer>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const counterContainer = document.getElementById('counter');
                const targetNumber = parseInt(counterContainer.dataset.number);
                const digitsLength = targetNumber.toString().length;
                const duration = 2000;
                const steps = 60;
                const stepDuration = duration / steps;
                let current = 0;

                function updateDigits(num) {
                    const digits = num.toString().padStart(digitsLength, '0').split('');
                    const spans = counterContainer.querySelectorAll('span');

                    digits.forEach((digit, index) => {
                        if (spans[index]) {
                            spans[index].textContent = digit;
                        }
                    });
                }

                function animate() {
                    const increment = targetNumber / steps;
                    const interval = setInterval(() => {
                        current += increment;
                        if (current >= targetNumber) {
                            updateDigits(targetNumber);
                            clearInterval(interval);
                        } else {
                            updateDigits(Math.floor(current));
                        }
                    }, stepDuration);
                }

                animate();
            });
        </script>
    @endpush
