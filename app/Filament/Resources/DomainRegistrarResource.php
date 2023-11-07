<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DomainRegistrarResource\Pages;
use App\Filament\Resources\DomainRegistrarResource\RelationManagers;
use App\Models\DomainRegistrar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DomainRegistrarResource extends Resource
{
    protected static ?string $model = DomainRegistrar::class;

    protected static ?string $navigationGroup = 'Hosting & Domain';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('registrar_name')
                    ->unique()
                    ->autofocus()
                    ->required()
                    ->placeholder(__('Registrar Name')),
                Forms\Components\TextInput::make('website')
                    ->unique()
                    ->autofocus()
                    ->required()
                    ->placeholder(__('Website')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('registrar_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('website')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_domain')
                    ->getStateUsing(function (DomainRegistrar $model) {
                        return $model->Domain()->count();
                    })
                    ->searchable()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\DomainRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDomainRegistrars::route('/'),
            'create' => Pages\CreateDomainRegistrar::route('/create'),
            'edit' => Pages\EditDomainRegistrar::route('/{record}/edit'),
        ];
    }
}
