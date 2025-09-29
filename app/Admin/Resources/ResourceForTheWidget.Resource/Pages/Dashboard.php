<?php

namespace App\Admin\Resources\ResourceForTheWidget.Resource\Pages;

use App\Admin\Resources\ResourceForTheWidget.Resource;
use Filament\Resources\Pages\Page;

class Dashboard extends Page
{
    protected static string $resource = ResourceForTheWidget.Resource::class;

    protected static string $view = 'filament.admin.resources.resource-for-the-widget.-resource.pages.dashboard';
}
