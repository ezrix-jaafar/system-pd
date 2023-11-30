<?php

namespace App\Filament\Resources\DailyWorkingReportSaleResource\Pages;

use App\Filament\Resources\DailyWorkingReportSaleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDailyWorkingReportSales extends ListRecords
{
    protected static string $resource = DailyWorkingReportSaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
