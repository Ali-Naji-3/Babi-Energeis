<?php

namespace App\Admin\Resources\TechnicianResource\Pages;

use App\Admin\Resources\TechnicianResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTechnicians extends ListRecords
{
    protected static string $resource = TechnicianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
