<?php

namespace App\Filament\Resources\DailyWorkingReportOperationResource\Pages;

use App\Filament\Resources\DailyWorkingReportOperationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDailyWorkingReportOperations extends ListRecords
{
    protected static string $resource = DailyWorkingReportOperationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
