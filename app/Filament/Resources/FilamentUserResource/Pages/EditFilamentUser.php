<?php

namespace App\Filament\Resources\FilamentUserResource\Pages;

use App\Filament\Resources\FilamentUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFilamentUser extends EditRecord
{
    protected static string $resource = FilamentUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
