<?php

namespace App\Filament\Resources\DailyWorkingReportSaleResource\Pages;

use App\Filament\Resources\DailyWorkingReportSaleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDailyWorkingReportSale extends EditRecord
{
    protected static string $resource = DailyWorkingReportSaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
