<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssetResource\Pages;
use App\Filament\Resources\AssetResource\RelationManagers;
use App\Models\Asset;
use Faker\Provider\Text;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AssetResource extends Resource
{
    protected static ?string $model = Asset::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()

                    ->schema([

                        Forms\Components\Section::make('Asset Details')

                            ->schema([


                                Forms\Components\Select::make('asset_type')
                                    ->options([
                                        'MobilePhone' => 'Mobile Phone',
                                        'Laptop' => 'Laptop',
                                        'Desktop' => 'Desktop',
                                    ])
                                    ->required(),

                                TextInput::make('brand'),
                                TextInput::make('model'),
                                TextInput::make('serial_number'),
                                TextInput::make('ram'),
                                TextInput::make('storage'),
                                Forms\Components\DatePicker::make('purchase_date'),
                                Forms\Components\DatePicker::make('warranty_expired'),
                                Forms\Components\FileUpload::make('purchase_receipt')
                                    ->image()
                                    ->imageEditor()
                                    ->openable()
                                    ->columnSpan('full'),

                            ])->columns(2),

                    ]),


                Forms\Components\Group::make()

                    ->schema([

                        Forms\Components\Section::make('Status')

                            ->schema([
                                Toggle::make('is_available')
                                    ->onColor('success')
                                    ->offColor('danger'),

                                Toggle::make('is_working')
                                    ->onColor('success')
                                    ->offColor('danger'),

                                Forms\Components\Textarea::make('notes')
                            ]),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('brand'),
                Tables\Columns\TextColumn::make('ram')
                    ->suffix('GB'),
                Tables\Columns\TextColumn::make('storage')
                    ->suffix('GB'),
                Tables\Columns\TextColumn::make('asset_type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'MobilePhone' => 'info',
                        'Laptop' => 'success',
                        'Desktop' => 'warning',
                    }),
                Tables\Columns\IconColumn::make('is_available')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_working')
                    ->boolean(),

            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
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
            RelationManagers\OwnerRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAssets::route('/'),
            'create' => Pages\CreateAsset::route('/create'),
            'edit' => Pages\EditAsset::route('/{record}/edit'),
        ];
    }
}
