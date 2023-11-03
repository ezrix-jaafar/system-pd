<?php

namespace App\Filament\Resources\HostingProviderResource\Pages;

use App\Filament\Resources\HostingProviderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHostingProviders extends ListRecords
{
    protected static string $resource = HostingProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
