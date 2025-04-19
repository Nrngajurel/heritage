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
        nav{
            background-color: rgb(17 24 39 / var(--tw-bg-opacity));
        }
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
        <div class="relative overflow-hidden pb-16 pt-32">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="relative z-10 text-center">
                    <h1
                        class="pageant-heading mb-4 text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">
                        Application Form
                    </h1>
                </div>
            </div>
        </div>



        

        <div id="application-form" x-show="showApplicationForm">

            {{ \Filament\Facades\Filament::renderHook('content.start') }}

            <div class="min-h-screen bg-gray-100">
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
