<?php

namespace App\Filament\Resources\SocialMediaAssetResource\Pages;

use App\Filament\Resources\SocialMediaAssetResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSocialMediaAsset extends EditRecord
{
    protected static string $resource = SocialMediaAssetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
