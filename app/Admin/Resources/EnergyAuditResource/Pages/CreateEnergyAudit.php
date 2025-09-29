<?php

namespace App\Admin\Resources\EnergyAuditResource\Pages;

use App\Admin\Resources\EnergyAuditResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEnergyAudit extends CreateRecord
{
    protected static string $resource = EnergyAuditResource::class;
}
