<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HostingProviderResource\Pages;
use App\Filament\Resources\HostingProviderResource\RelationManagers;
use App\Models\HostingProvider;
use Faker\Provider\Text;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HostingProviderResource extends Resource
{
    protected static ?string $model = HostingProvider::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('hosting_company')
                    ->unique()
                    ->autofocus()
                    ->required()
                    ->placeholder(__('Hosting Company')),
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
                //
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHostingProviders::route('/'),
            'create' => Pages\CreateHostingProvider::route('/create'),
            'edit' => Pages\EditHostingProvider::route('/{record}/edit'),
        ];
    }
}
