<?php

namespace App\Providers;

use Filament\Forms\Components\Actions\Action;
use Livewire\Livewire;

class FilamentServiceProvider extends \Filament\FilamentServiceProvider
{
    public function boot(): void
    {
        // ... other boot code ...

        Livewire::component('new-application-form', \App\Filament\Pages\NewApplicationForm::class);
    }
} 