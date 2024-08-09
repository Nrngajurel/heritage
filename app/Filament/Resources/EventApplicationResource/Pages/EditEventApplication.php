<?php

namespace App\Filament\Resources\EventApplicationResource\Pages;

use App\Filament\Resources\EventApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEventApplication extends EditRecord
{
    protected static string $resource = EventApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
