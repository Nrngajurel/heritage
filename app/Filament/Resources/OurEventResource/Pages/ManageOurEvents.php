<?php

namespace App\Filament\Resources\OurEventResource\Pages;

use App\Filament\Resources\OurEventResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageOurEvents extends ManageRecords
{
    protected static string $resource = OurEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
