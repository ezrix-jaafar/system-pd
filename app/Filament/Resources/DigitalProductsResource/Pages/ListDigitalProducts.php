<?php

namespace App\Filament\Resources\DigitalProductsResource\Pages;

use App\Filament\Resources\DigitalProductsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDigitalProducts extends ListRecords
{
    protected static string $resource = DigitalProductsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
