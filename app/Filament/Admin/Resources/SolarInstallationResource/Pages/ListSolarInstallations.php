<?php

namespace App\Filament\Admin\Resources\SolarInstallationResource\Pages;

use App\Filament\Admin\Resources\SolarInstallationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSolarInstallations extends ListRecords
{
    protected static string $resource = SolarInstallationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
