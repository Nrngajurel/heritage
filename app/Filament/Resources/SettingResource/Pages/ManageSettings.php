<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use Filament\Resources\Pages\EditRecord;
use App\Models\Setting;

class ManageSettings extends EditRecord
{
    protected static string $resource = SettingResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return $data;
    }
}