<?php

namespace App\Filament\Admin\Resources\EnergyAuditResource\Pages;

use App\Filament\Admin\Resources\EnergyAuditResource;
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
