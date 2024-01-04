<?php

namespace App\Filament\Resources\DailyWorkingReportOperationResource\Pages;

use App\Filament\Resources\DailyWorkingReportOperationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDailyWorkingReportOperation extends EditRecord
{
    protected static string $resource = DailyWorkingReportOperationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
