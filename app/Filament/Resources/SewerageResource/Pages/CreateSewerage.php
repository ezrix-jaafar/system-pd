<?php

namespace App\Filament\Resources\SewerageResource\Pages;

use App\Filament\Resources\SewerageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSewerage extends CreateRecord
{
    protected static string $resource = SewerageResource::class;
    protected static ?string $title = 'Add New Bill';
}
