@extends('layouts.frontend-new')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900">
        <!-- Banner Section -->
        <div class="relative overflow-hidden pb-16 pt-32">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="relative z-10 text-center">
                    <h1
                        class="pageant-heading">
                        Blog & News
                    </h1>
                    <p class="mx-auto mt-4 max-w-2xl text-xl text-gray-300">
                        Stay updated with our latest stories and announcements
                    </p>
                </div>
            </div>
        </div>

        <!-- Blog Posts Section -->
        <div class="container mx-auto px-4 py-16">
            <div class="mx-auto max-w-7xl">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($blog_news as $post)
                        @include('frontend.partials.post-card', ['post' => $post])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
