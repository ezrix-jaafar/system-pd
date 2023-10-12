<?php

namespace App\Filament\Resources\DigitalProductsResource\Pages;

use App\Filament\Resources\DigitalProductsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDigitalProducts extends EditRecord
{
    protected static string $resource = DigitalProductsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
