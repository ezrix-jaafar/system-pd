<?php

namespace App\Filament\Resources\DomainRegistrarResource\Pages;

use App\Filament\Resources\DomainRegistrarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDomainRegistrars extends ListRecords
{
    protected static string $resource = DomainRegistrarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
