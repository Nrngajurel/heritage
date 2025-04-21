@extends('layouts.frontend-new')

@section('title', "Voting")
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
@endpush

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900">
        <!-- Banner Section -->
        <div class="relative overflow-hidden pb-16 pt-32">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="relative z-10 text-center">
                    <h1 class="pageant-heading mb-4 text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">
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
                            <a 
                                href="{{ \Storage::url($image) }}"
                                data-fancybox="gallery-{{ $item->id }}"
                                data-caption="{{ $item->title }}"
                                class="cursor-pointer overflow-hidden"
                            >
                                <img 
                                    src="{{ \Storage::url($image) }}" 
                                    alt="{{ $item->title }}"
                                    class="h-full w-full object-cover"
                                    loading="lazy"
                                >
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
    @endpush
@endsection
