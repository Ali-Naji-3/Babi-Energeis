<?php

namespace App\Admin\Resources\MaintenanceVisitResource\Pages;

use App\Admin\Resources\MaintenanceVisitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMaintenanceVisit extends EditRecord
{
    protected static string $resource = MaintenanceVisitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
