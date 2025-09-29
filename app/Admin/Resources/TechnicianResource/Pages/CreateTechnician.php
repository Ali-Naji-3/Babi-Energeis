<?php

namespace App\Admin\Resources\TechnicianResource\Pages;

use App\Admin\Resources\TechnicianResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTechnician extends CreateRecord
{
    protected static string $resource = TechnicianResource::class;
}
