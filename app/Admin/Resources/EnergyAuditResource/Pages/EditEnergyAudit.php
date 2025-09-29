<?php

namespace App\Admin\Resources\EnergyAuditResource\Pages;

use App\Admin\Resources\EnergyAuditResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEnergyAudit extends EditRecord
{
    protected static string $resource = EnergyAuditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
