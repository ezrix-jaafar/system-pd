<?php

namespace App\Filament\Resources\TaxLicensingResource\Pages;

use App\Filament\Resources\TaxLicensingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTaxLicensings extends ListRecords
{
    protected static string $resource = TaxLicensingResource::class;
    protected static ?string $title = 'Tax & Licensing Bills';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
