<?php

namespace App\Filament\Resources\TaxLicensingResource\Pages;

use App\Filament\Resources\TaxLicensingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTaxLicensing extends CreateRecord
{
    protected static string $resource = TaxLicensingResource::class;
    protected static ?string $title = 'Add New Bill';
}
