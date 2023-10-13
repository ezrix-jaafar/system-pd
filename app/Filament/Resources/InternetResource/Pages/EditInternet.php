<?php

namespace App\Filament\Resources\InternetResource\Pages;

use App\Filament\Resources\InternetResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInternet extends EditRecord
{
    protected static string $resource = InternetResource::class;

    protected static ?string $title = 'Edit Bills';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
