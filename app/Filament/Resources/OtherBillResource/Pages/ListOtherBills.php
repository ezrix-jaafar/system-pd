<?php

namespace App\Filament\Resources\OtherBillResource\Pages;

use App\Filament\Resources\OtherBillResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOtherBills extends ListRecords
{
    protected static string $resource = OtherBillResource::class;
    protected static ?string $title = 'Other Bills';


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
