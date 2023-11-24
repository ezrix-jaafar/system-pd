<?php

namespace App\Filament\Resources\OtherBillResource\Pages;

use App\Filament\Resources\OtherBillResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOtherBill extends CreateRecord
{
    protected static string $resource = OtherBillResource::class;
    protected static ?string $title = 'Add New Bill';
}
