<?php

namespace App\Filament\Resources\TaxLicensingResource\Pages;

use App\Filament\Resources\TaxLicensingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTaxLicensing extends EditRecord
{
    protected static string $resource = TaxLicensingResource::class;
    protected static ?string $title = 'Edit Bill';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
