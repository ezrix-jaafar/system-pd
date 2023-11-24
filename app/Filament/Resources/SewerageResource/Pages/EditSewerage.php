<?php

namespace App\Filament\Resources\SewerageResource\Pages;

use App\Filament\Resources\SewerageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSewerage extends EditRecord
{
    protected static string $resource = SewerageResource::class;
    protected static ?string $title = 'Edit Bill';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
