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

        <div class="bg-gray-100 min-h-screen">
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
@section('title', $event->title)

@section('content')
    <div class="bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 min-h-screen" x-data="{ showApplicationForm: true, showApplicationSubmitted: false }"
        x-init="Livewire.on('application-submitted', function() {
            console.log('application-submitted');
            showApplicationForm = false;
            showApplicationSubmitted = true;
        });">

        <!-- Banner Section -->
        <div class="relative bg-gradient-to-b from-gray-900 to-gray-800 pt-24 pb-12 overflow-hidden">
            <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
                <div class="z-10 relative text-center">
                    <h1 class="pageant-heading">
                        Application Form
                    </h1>
                    <p class="mx-auto mb-4 max-w-3xl font-light text-gold/80 text-xl">
                        Join us in celebrating beauty and heritage
                    </p>
                </div>
            </div>
            <!-- Decorative elements -->
            <div class="top-1/2 left-1/2 absolute w-full max-w-7xl h-full -translate-x-1/2 -translate-y-1/2">
                <div class="top-1/4 left-1/4 absolute sparkle"></div>
                <div class="top-3/4 right-1/4 absolute sparkle" style="animation-delay: 0.5s"></div>
                <div class="top-1/2 left-1/2 absolute sparkle" style="animation-delay: 1s"></div>
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
