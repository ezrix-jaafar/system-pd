<?php

namespace App\Filament\Resources\TrainingResource\Pages;

use App\Filament\Resources\TrainingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTraining extends CreateRecord
{
    protected static string $resource = TrainingResource::class;
    protected static ?string $title = 'Add New Bill';
}
