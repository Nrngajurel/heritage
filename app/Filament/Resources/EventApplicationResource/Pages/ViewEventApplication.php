<?php

namespace App\Filament\Resources\EventApplicationResource\Pages;

use App\Filament\Resources\EventApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEventApplication extends ViewRecord
{
    protected static string $view = 'filament.resources.application.pages.view-application';
    protected static string $resource = EventApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
