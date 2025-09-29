<?php

namespace App\Admin\Resources\SolarInstallationResource\Pages;

use App\Admin\Resources\SolarInstallationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSolarInstallation extends EditRecord
{
    protected static string $resource = SolarInstallationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
