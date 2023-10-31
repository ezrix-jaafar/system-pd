<?php

namespace App\Filament\Resources\SocialMediaAssetResource\Pages;

use App\Filament\Resources\SocialMediaAssetResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSocialMediaAssets extends ListRecords
{
    protected static string $resource = SocialMediaAssetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
