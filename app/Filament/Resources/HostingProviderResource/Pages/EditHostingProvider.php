<?php

namespace App\Filament\Resources\HostingProviderResource\Pages;

use App\Filament\Resources\HostingProviderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHostingProvider extends EditRecord
{
    protected static string $resource = HostingProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
