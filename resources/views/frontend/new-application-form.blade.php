<!DOCTYPE html>
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
        {{-- @vite('resources/js/app.js') --}}
    </body>
</html> 