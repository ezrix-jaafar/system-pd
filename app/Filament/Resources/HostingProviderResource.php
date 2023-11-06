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

    protected static ?string $navigationGroup = 'Hosting & Domain';
    protected static ?int $navigationSort = 5;

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
                Tables\Columns\TextColumn::make('hosting_company')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('website')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_hosting')
                    ->getStateUsing(function (HostingProvider $model) {
                        return $model->Hosting()->count();
                    })
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                \Filament\Tables\Actions\ActionGroup::make([
                    \Filament\Tables\Actions\ViewAction::make(),
                    \Filament\Tables\Actions\EditAction::make(),
                    \Filament\Tables\Actions\DeleteAction::make(),
                ]),
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
            RelationManagers\HostingRelationManager::class,
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
