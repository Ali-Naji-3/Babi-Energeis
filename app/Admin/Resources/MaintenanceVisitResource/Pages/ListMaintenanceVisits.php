<?php

namespace App\Admin\Resources\MaintenanceVisitResource\Pages;

use App\Admin\Resources\MaintenanceVisitResource;
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
