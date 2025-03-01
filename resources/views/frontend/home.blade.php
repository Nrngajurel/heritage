@extends('layouts.frontend-new')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>

        .hero-slider .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .shimmer {
            background: linear-gradient(90deg, #FFD700 0%, #fff 50%, #FFD700 100%);
            background-size: 200% auto;
            color: transparent;
            background-clip: text;
            -webkit-background-clip: text;
            animation: shimmer 3s linear infinite;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #FFD700 !important;
            width: 50px !important;
            height: 50px !important;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: rgba(0, 0, 0, 0.8);
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 24px !important;
        }

        .swiper-pagination-bullet {
            width: 12px;
            height: 12px;
            background: rgba(255, 215, 0, 0.5);
        }

        .swiper-pagination-bullet-active {
            background: #FFD700 !important;
        }

        @keyframes shimmer {
            to {
                background-position: 200% center;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Hero Slider Section -->
    <div class="relative overflow-hidden bg-gradient-to-b from-gray-900 to-gray-800 pt-24">
        <div class="swiper hero-slider">
            <div class="swiper-wrapper">
                @foreach (['https://heritagepageant.com/wp-content/uploads/2025/01/MHI_Web-Banner-1250x390.jpg', 'https://heritagepageant.com/wp-content/uploads/2025/01/MHI_Web-Banner_-1250x390.jpg', 'https://heritagepageant.com/wp-content/uploads/2025/02/MHI_Web-Banner_-copy-1250x390.jpg'] as $image)
                    <div class="swiper-slide">
                        <div class="relative w-full">
                            <img src="{{ $image }}" class="w-full object-cover" alt="Heritage Pageant">
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>

    <!-- Introduction Section -->
    <section class="bg-black py-20">
        <div class="container mx-auto px-4">
            <h1 class="font-cinzel shimmer mb-8 text-center text-5xl text-[#e4cb86]">PAGEANT OF HERITAGE</h1>
            <div class="mx-auto mb-12 max-w-4xl text-center text-white">
                <p class="mb-6">Pageant of Heritage is an ultimate international beauty pageant that endeavours to promote
                    Peace, Environment, Tourism, Culture and above all global Heritage (P.E.T.C.H.) from a global
                    perspective. The Heritage Pageants beauty pageant was founded in 2011 by Eplanet private limited
                    (Turning Events into Indelible Memories) entity upon the apprehension of the Indispensable rationale of
                    beauty pageants in promoting fundamental global agendas. Pageant of Heritage also known as Heritage
                    pageants.</p>
                <h2 class="mb-4 text-2xl text-[#e4cb86]">Heritage Pageants celebrate peace, environmental awareness,
                    tourism, culture, and heritage.</h2>
            </div>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                @foreach (['https://heritagepageant.com/wp-content/uploads/elementor/thumbs/1C1A8662-qmmw96uotbwh9pa0ive1p04cq70qg3di2h23s001rw.jpg', 'https://heritagepageant.com/wp-content/uploads/2024/04/1C1A9041.jpg', 'https://heritagepageant.com/wp-content/uploads/2023/11/WhatsApp-Image-2023-11-14-at-10.21.15-PM.jpeg'] as $image)
                    <div class="fade-up group relative overflow-hidden rounded-lg">
                        <img src="{{ $image }}"
                            class="h-80 w-full object-cover transition-transform duration-300 group-hover:scale-110"
                            alt="Heritage Pageant">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Video Section -->
    <section class="bg-black py-20">
        <div class="container mx-auto px-4">
            <div class="fade-up relative overflow-hidden rounded-lg">
                <img src="https://i.ytimg.com/vi_webp/uvUqpB1wp1w/mqdefault.webp" class="h-full w-full object-cover" alt="Heritage Pageant Video">
                <div class="absolute inset-0 bg-black/50"></div>
                <button class="absolute inset-0 flex transform items-center justify-center transition duration-300 hover:scale-110"
                    onclick="this.nextElementSibling.classList.remove('hidden')">
                    <svg width="200px" height="200px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM10.6935 15.8458L15.4137 13.059C16.1954 12.5974 16.1954 11.4026 15.4137 10.941L10.6935 8.15419C9.93371 7.70561 9 8.28947 9 9.21316V14.7868C9 15.7105 9.93371 16.2944 10.6935 15.8458Z" fill="#e4cb86"
                            style="filter: drop-shadow(0 0 10px #e4cb86); animation: pulse 2s infinite;"/>
                    </svg>
                </button>


                <div class="hidden">
                    <iframe class="absolute inset-0 h-full w-full"
                        src="https://www.youtube.com/embed/uvUqpB1wp1w?feature=oembed?playlist=uvUqpB1wp1w&mute=0&autoplay=1&loop=&controls=0&start=&end="
                        frameborder="0"
                        allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Title Holders Section -->
    <section class="bg-black py-20">
        <div class="container mx-auto px-4">
            <h2 class="font-cinzel shimmer mb-12 text-center text-4xl text-[#e4cb86]">OUR PROUD TITLEHOLDERS</h2>
            <div class="swiper title-holders-slider">
                <div class="swiper-wrapper">
                    @foreach (['https://heritagepageant.com/wp-content/uploads/2024/04/Mis-Heritage-2014-200x300.jpg', 'https://heritagepageant.com/wp-content/uploads/2024/04/2015-200x300.jpg', 'https://heritagepageant.com/wp-content/uploads/2024/04/Miss-2016-200x300.jpg', 'https://heritagepageant.com/wp-content/uploads/2024/04/2019-1-200x300.jpg', 'https://heritagepageant.com/wp-content/uploads/2023/09/Russia-8-200x300.jpg', 'https://heritagepageant.com/wp-content/uploads/2023/10/WhatsApp-Image-2023-10-01-at-5.52.50-PM-300x300.jpeg', 'https://heritagepageant.com/wp-content/uploads/2024/06/MISS-HERITAGE-INTERNATIONAL-2023.jpg', 'https://heritagepageant.com/wp-content/uploads/2024/06/MRS-HERITAGE-INTERNATIONAL-2016.jpg', 'https://heritagepageant.com/wp-content/uploads/2024/06/MRS-HERITAGE-INTERNATIONAL-2019.jpg', 'https://heritagepageant.com/wp-content/uploads/2024/06/MRS-HERITAGE-INTERNATIONAL-2022.jpg', 'https://heritagepageant.com/wp-content/uploads/2024/06/MRS-HERITAGE-INTERNATIONAL-2023.jpg'] as $index => $image)
                        <div class="swiper-slide">
                            <div class="group relative overflow-hidden rounded-lg">
                                <img src="{{ $image }}" class="h-[450px] w-full object-cover" alt="Title Holder">
                                <div
                                    class="absolute inset-0 flex items-end justify-center bg-gradient-to-t from-black/80 to-transparent p-6 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                    <div class="text-center">
                                        <h3 class="text-xl font-semibold text-[#e4cb86]">Heritage Queen {{ 2024 - $index }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </section>

    <!-- Moments Section -->
    <section class="bg-black py-20">
        <div class="container mx-auto px-4">
            <h2 class="font-cinzel shimmer mb-12 text-center text-4xl text-[#e4cb86]">MOMENTS</h2>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-5">
                @foreach ([['https://mrsheritageinternational.com/wp-content/uploads/2024/04/Peace.jpg', 'PEACE'], ['https://mrsheritageinternational.com/wp-content/uploads/2024/04/1C1A5078-1-scaled.jpg', 'ENVIRONMENT'], ['https://mrsheritageinternational.com/wp-content/uploads/2024/04/benGGy2202.jpg', 'TOURISM'], ['https://mrsheritageinternational.com/wp-content/uploads/2024/04/hERITAGE.jpg', 'CULTURE'], ['https://mrsheritageinternational.com/wp-content/uploads/2024/04/hERITAGE-copy.jpg', 'HERITAGE']] as [$image, $label])
                    <div
                        class="group relative cursor-pointer overflow-hidden rounded-lg transition-all duration-500 hover:flex-grow">
                        <img src="{{ $image }}"
                            class="h-96 w-full object-cover transition-transform duration-500 group-hover:scale-110"
                            alt="{{ $label }}">
                        <div
                            class="absolute inset-0 flex items-end justify-center bg-gradient-to-t from-black/80 to-transparent p-6">
                            <h3 class="text-2xl font-bold text-[#e4cb86]">{{ $label }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Heritage Highlights Section -->
    <section class="bg-black py-20">
        <div class="container mx-auto px-4">
            <h2 class="font-cinzel shimmer mb-12 text-center text-4xl text-[#e4cb86]">Heritage Highlights</h2>
            <div class="swiper highlights-slider">
                <div class="swiper-wrapper">
                    @foreach (['https://heritagepageant.com/wp-content/uploads/2023/11/WhatsApp-Image-2023-11-14-at-10.26.33-PM-2.jpeg', 'https://heritagepageant.com/wp-content/uploads/2023/11/WhatsApp-Image-2023-11-14-at-10.26.33-PM-3.jpeg', 'https://heritagepageant.com/wp-content/uploads/2023/11/WhatsApp-Image-2023-11-14-at-10.26.34-PM-1.jpeg'] as $image)
                        <div class="swiper-slide">
                            <div class="group relative overflow-hidden rounded-lg">
                                <img src="{{ $image }}" class="h-[400px] w-full object-cover"
                                    alt="Heritage Highlight">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="bg-black py-20">
        <div class="container mx-auto px-4">
            <h2 class="font-cinzel shimmer mb-4 text-center text-4xl text-[#e4cb86]">News Media Coverage</h2>
            <h3 class="mb-12 text-center text-2xl text-white">HERITAGE PAGEANTS 2023</h3>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                @foreach ([
            [
                'image' => 'https://heritagepageant.com/wp-content/uploads/2023/12/1c1a7795-1_orig.jpg',
                'title' => 'Venezuela wins MRS. HERITAGE while Japan bags MISS HERITAGE INTERNATIONAL 2023',
                'source' => 'world fashion media news magazine',
            ],
            [
                'image' => 'https://heritagepageant.com/wp-content/uploads/2023/12/IMG_4627-1.jpeg',
                'title' => 'Two beautiful beauties from Japan and Venezuela won the Miss/Mrs. Heritage International 2023 crown.',
                'source' => 'TV Pool',
            ],
            [
                'image' => 'https://heritagepageant.com/wp-content/uploads/2023/12/www.tingbt.com-img-1435-696x463-1.jpeg',
                'title' => 'International beauty pageant, Heritage Pageants 2023, announces readiness',
                'source' => 'TBT News',
            ],
        ] as $article)
                    <div class="fade-up overflow-hidden rounded-lg bg-white/5">
                        <img src="{{ $article['image'] }}" class="h-48 w-full object-cover" alt="{{ $article['title'] }}">
                        <div class="p-6">
                            <h3 class="mb-2 text-xl font-semibold text-[#e4cb86]">{{ $article['title'] }}</h3>
                            <p class="text-sm text-gray-400">{{ $article['source'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8 text-center">
                <a href="/news"
                    class="inline-block border-2 border-[#e4cb86] px-8 py-3 text-[#e4cb86] transition-colors duration-300 hover:bg-[#e4cb86] hover:text-black">View
                    More News</a>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="bg-black py-20">
        <div class="container mx-auto px-4">
            <h2 class="font-cinzel shimmer mb-12 text-center text-4xl text-[#e4cb86]">Our Blog</h2>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                @foreach ([
            [
                'image' => 'https://heritagepageant.com/wp-content/uploads/2023/09/International-Beauty.webp',
                'title' => 'मिस हेरिटेज इन्टरनेसनलमा सहभागि हुन अन्तर्राष्ट्रिय सुन्दरीहरु नेपालमा',
                'excerpt' => 'मिस हेरिटेज इन्टरनेसनलमा सहभागि हुन अन्तर्राष्ट्रिय सुन्दरीहरु नेपालमा\'बुद्ध र सगरमाथा नेपालीको पहिचान...',
            ],
            [
                'image' => 'https://heritagepageant.com/wp-content/uploads/2023/09/Miss-Heritage-International-2015-winners.webp',
                'title' => 'Nepali belle wins titles in Miss Heritage Int\'l',
                'excerpt' => 'Miss Heritage International 2015, a beauty pageant initiated to preserve the UNESCO heritage and cultural sites...',
            ],
            [
                'image' => 'https://heritagepageant.com/wp-content/uploads/2023/09/Award.webp',
                'title' => 'Santosh Sapkota receives International Award',
                'excerpt' => 'Eplanet Nepal one of the leading beauty pageant organizer and management company of Nepal...',
            ],
        ] as $post)
                    <div class="fade-up overflow-hidden rounded-lg bg-white/5">
                        <img src="{{ $post['image'] }}" class="h-56 w-full object-cover" alt="{{ $post['title'] }}">
                        <div class="p-6">
                            <h3 class="mb-4 text-xl font-semibold text-[#e4cb86]">{{ $post['title'] }}</h3>
                            <p class="mb-4 text-gray-400">{{ $post['excerpt'] }}</p>
                            <a href="#" class="text-[#e4cb86] transition-colors duration-300 hover:text-white">Read
                                More →</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@push('scripts')

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hero Slider
            new Swiper('.hero-slider', {
                loop: true,
                speed: 1000,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });

            // Title Holders Slider
            new Swiper('.title-holders-slider', {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                speed: 800,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                    },
                    768: {
                        slidesPerView: 3,
                    },
                    1024: {
                        slidesPerView: 4,
                    },
                },
            });

            // Highlights Slider
            new Swiper('.highlights-slider', {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                speed: 800,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                },
            });
        });
    </script>
@endpush
