<?php

namespace App\Filament\Resources\ElectricityResource\Pages;

use App\Filament\Resources\ElectricityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListElectricities extends ListRecords
{
    protected static string $resource = ElectricityResource::class;

    protected static ?string $title = 'Electricty Bills';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Add new bill'),
        ];
    }
}
