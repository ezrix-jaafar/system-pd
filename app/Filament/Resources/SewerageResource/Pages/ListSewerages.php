<?php

namespace App\Filament\Resources\SewerageResource\Pages;

use App\Filament\Resources\SewerageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSewerages extends ListRecords
{
    protected static string $resource = SewerageResource::class;
    protected static ?string $title = 'Sewerage Bills';


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
