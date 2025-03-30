@extends('layouts.frontend-new')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900">
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

        <!-- Gallery Content -->
        <div >
            @filamentStyles
            {{ \Filament\Facades\Filament::renderHook('content.start') }}
            @livewire(\App\Filament\Pages\NewApplicationForm::class, [
                'event' => $event,
            ])

            {{ \Filament\Facades\Filament::renderHook('content.end') }}

            @filamentScripts
        </div>
    </div>
@endsection
