@extends('layouts.frontend-new')

@section('title', 'Voting')
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

    <style>
        /* shimmer effect */
        .shimmer {
            background: linear-gradient(to right,
                    #2a2a2a 8%,
                    #3a3a3a 18%,
                    #2a2a2a 33%);
            background-size: 1200px 100%;
            animation: shimmer 1.2s infinite linear;
            min-height: 150px;
        }

        @keyframes shimmer {
            0% {
                background-position: -1200px 0;
            }

            100% {
                background-position: 1200px 0;
            }
        }
    </style>
@endpush

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900">
        <!-- Banner Section -->
        <div class="relative overflow-hidden pb-16 pt-32">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="relative z-10 text-center">
                    <h1 class="pageant-heading">
                        Photo Gallery
                    </h1>
                </div>
            </div>
        </div>

        <!-- Gallery Content -->
        <div class="mx-auto max-w-7xl px-4 py-8">
            @foreach ($gallery as $item)
                <div class="mb-8">
                    <!-- Section Title -->
                    <h2 class="mb-4 text-2xl font-bold text-white">{{ $item->title }}</h2>

                    <!-- Image Grid -->
                    <div class="grid grid-cols-2 gap-2 md:grid-cols-3 lg:grid-cols-4">
                        @foreach ($item->images as $key => $image)
                            <a href="{{ \Storage::url($image) }}" data-fancybox="gallery-{{ $item->id }}"
                                data-caption="{{ $item->title }}" class="cursor-pointer overflow-hidden">
                                <img data-src="{{ \Storage::url($image) }}"
                                    src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw=="
                                    alt="{{ $item->title }}" class="lazy-img shimmer h-full w-full object-cover">
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
        <script>
            Fancybox.bind("[data-fancybox]", {
                // Custom options
                Toolbar: {
                    display: {
                        left: [],
                        middle: [],
                        right: ["close"],
                    },
                },
                Images: {
                    zoom: true,
                },
                Carousel: {
                    transition: "slide",
                },
                // Custom styling
                template: {
                    // Customize Fancybox UI elements here if needed
                },
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const images = document.querySelectorAll('img.lazy-img');

                const observer = new IntersectionObserver((entries, obs) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            const src = img.getAttribute('data-src');
                            if (src) {
                                img.src = src;
                                img.onload = () => img.classList.remove('shimmer');
                                img.removeAttribute('data-src');
                            }
                            obs.unobserve(img);
                        }
                    });
                }, {
                    rootMargin: '0px 0px 200px 0px', // preload before user sees it
                    threshold: 0.1
                });

                images.forEach(img => observer.observe(img));
            });
        </script>
    @endpush
@endsection
