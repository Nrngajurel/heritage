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
                        {{ $event->name }}
                    </h1>
                </div>
            </div>
        </div>
        <div>
            <div class="container mx-auto px-4 py-8">
                <p class="text-gray-300">
                    {{ $event->description }}
                </p>
                
            </div>
        </div>

        
    </div>

@endsection
