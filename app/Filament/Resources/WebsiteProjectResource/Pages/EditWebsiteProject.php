<?php

namespace App\Filament\Resources\WebsiteProjectResource\Pages;

use App\Filament\Resources\WebsiteProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWebsiteProject extends EditRecord
{
    protected static string $resource = WebsiteProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
