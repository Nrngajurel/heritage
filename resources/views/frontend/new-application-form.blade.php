{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @filamentStyles
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased">
        {{ \Filament\Facades\Filament::renderHook('content.start') }}

        <div class="min-h-screen bg-gray-100">
            @livewire(\App\Filament\Pages\NewApplicationForm::class, [
                'event' => $event
            ])
        </div>

        {{ \Filament\Facades\Filament::renderHook('content.end') }}

        @filamentScripts
        //@vite('resources/js/app.js')
    </body>
</html>  --}}


@extends('layouts.frontend-new')

@push('styles')
    @livewireStyles
    @filamentStyles

    <style>
        /* nav{
            background-color: rgb(17 24 39 / var(--tw-bg-opacity));
        } */
    </style>
@endpush

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900"
        x-data="{ showApplicationForm: true, showApplicationSubmitted: false }"
        x-init="
            Livewire.on('application-submitted', function() {
                console.log('application-submitted');
                showApplicationForm = false;
                showApplicationSubmitted = true;
            });
        "
    >
        
        <!-- Banner Section -->
        <div class="relative overflow-hidden bg-gradient-to-b from-gray-900 to-gray-800 pb-12 pt-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="relative z-10 text-center">
                    <h1 class="pageant-heading mb-4 text-4xl font-extrabold tracking-tight sm:text-5xl md:text-6xl">
                        Application Form
                    </h1>
                    <p class="text-gold/80 mx-auto mb-4 max-w-3xl text-xl font-light">
                        Join us in celebrating beauty and heritage
                    </p>
                </div>
            </div>
            <!-- Decorative elements -->
            <div class="absolute left-1/2 top-1/2 h-full w-full max-w-7xl -translate-x-1/2 -translate-y-1/2">
                <div class="sparkle absolute left-1/4 top-1/4"></div>
                <div class="sparkle absolute right-1/4 top-3/4" style="animation-delay: 0.5s"></div>
                <div class="sparkle absolute left-1/2 top-1/2" style="animation-delay: 1s"></div>
            </div>
        </div>



        

        <div id="application-form" x-show="showApplicationForm">

            {{ \Filament\Facades\Filament::renderHook('content.start') }}

            <div class="min-h-screen">
                @livewire(\App\Filament\Pages\NewApplicationForm::class, [
                    'event' => $event,
                ])
            </div>

            {{ \Filament\Facades\Filament::renderHook('content.end') }}

        </div>
    </div>
@endsection

@push('scripts')
    @livewireScripts
    @filamentScripts

@endpush
