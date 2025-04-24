@extends('layouts.frontend-new')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900">
        <!-- Banner Section -->
        <div class="relative overflow-hidden pb-16 pt-32">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="relative z-10 text-center">
                    <h1
                        class="pageant-heading">
                        {{ $post->title }}
                    </h1>
                    <p class="mt-4 text-gray-400">
                        {{ \Carbon\Carbon::parse($post->created_at)->format('F j, Y') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Blog Content Section -->
        <div class="container mx-auto px-4 py-16">
            <div class="mx-auto max-w-4xl">
                <div class="overflow-hidden rounded-lg bg-gray-800">
                    <img src="{{ asset('storage/' . $post->image) }}" class="w-full object-cover" alt="{{ $post->title }}">
                    <div class="p-8">
                        <div class="prose prose-lg prose-invert max-w-none">
                            {!! $post->description ?? 'No description available.' !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
