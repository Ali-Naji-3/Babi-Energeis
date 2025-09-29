<?php

namespace App\Admin\Resources\TechnicianResource\Pages;

use App\Admin\Resources\TechnicianResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTechnician extends EditRecord
{
    protected static string $resource = TechnicianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
