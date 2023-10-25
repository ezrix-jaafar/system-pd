<?php

namespace App\Filament\Resources\AdsProjectResource\Pages;

use App\Filament\Resources\AdsProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdsProject extends EditRecord
{
    protected static string $resource = AdsProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
