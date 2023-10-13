<?php

namespace App\Filament\Resources\FilamentUserResource\Pages;

use App\Filament\Resources\FilamentUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFilamentUsers extends ListRecords
{
    protected static string $resource = FilamentUserResource::class;

    protected static ?string $title = 'Staff';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
