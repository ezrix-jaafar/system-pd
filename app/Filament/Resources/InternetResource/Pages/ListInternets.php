<?php

namespace App\Filament\Resources\InternetResource\Pages;

use App\Filament\Resources\InternetResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInternets extends ListRecords
{
    protected static string $resource = InternetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
