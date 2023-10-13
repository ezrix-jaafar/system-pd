<?php

namespace App\Filament\Resources\FilamentUserResource\Pages;

use App\Filament\Resources\FilamentUserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFilamentUser extends CreateRecord
{
    protected static string $resource = FilamentUserResource::class;
}
