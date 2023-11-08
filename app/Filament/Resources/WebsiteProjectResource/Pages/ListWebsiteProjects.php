<?php

namespace App\Filament\Resources\WebsiteProjectResource\Pages;

use App\Filament\Resources\WebsiteProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWebsiteProjects extends ListRecords
{
    protected static string $resource = WebsiteProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
