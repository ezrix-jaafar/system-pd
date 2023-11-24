<?php

namespace App\Filament\Resources\OtherBillResource\Pages;

use App\Filament\Resources\OtherBillResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOtherBill extends EditRecord
{
    protected static string $resource = OtherBillResource::class;
    protected static ?string $title = 'Edit Bill';


    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
