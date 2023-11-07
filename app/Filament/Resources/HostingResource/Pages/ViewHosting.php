<?php

namespace App\Filament\Resources\HostingResource\Pages;

use App\Filament\Resources\HostingResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewHosting extends ViewRecord
{
    protected static string $resource = HostingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
