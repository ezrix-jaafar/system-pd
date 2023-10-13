<?php

namespace App\Filament\Resources\InternetResource\Pages;

use App\Filament\Resources\InternetResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInternet extends CreateRecord
{
    protected static string $resource = InternetResource::class;
    protected static ?string $title = 'Add New Bill';
}
