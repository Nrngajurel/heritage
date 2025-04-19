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
@endpush

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900"
        x-data="{ showApplicationForm: true, showApplicationSubmitted: false }"
        x-init="
            Livewire.on('application-submitted', function() {
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


        <div id="application-submitted" x-show="showApplicationSubmitted">
            <div class="flex items-center justify-center rounded-lg bg-white p-10 shadow">
                <div>
                    <svg class="mx-auto mb-4 h-20 w-20 text-green-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <h2 class="mb-4 text-center text-2xl font-bold text-gray-800">Application
                        Submitted
                        Success
                    </h2>
                    <div class="mb-8 text-gray-600">
                        Thank you. We have sent you an email
                        about status of the application
                    </div>
                    <button type="button" @click="window.location.reload()"
                        class="mx-auto block w-40 rounded-lg border bg-white px-5 py-2 text-center font-medium text-gray-600 shadow-sm hover:bg-gray-100 focus:outline-none">Back
                        to home</button>
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
