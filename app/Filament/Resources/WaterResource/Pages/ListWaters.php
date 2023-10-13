<?php

namespace App\Filament\Resources\WaterResource\Pages;

use App\Filament\Resources\WaterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWaters extends ListRecords
{
    protected static string $resource = WaterResource::class;
    protected static ?string $title = 'Water Bills';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Add new bill'),
        ];
    }
}
