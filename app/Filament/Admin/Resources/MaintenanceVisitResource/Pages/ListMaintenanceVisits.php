<?php

namespace App\Filament\Admin\Resources\MaintenanceVisitResource\Pages;

use App\Filament\Admin\Resources\MaintenanceVisitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMaintenanceVisits extends ListRecords
{
    protected static string $resource = MaintenanceVisitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
