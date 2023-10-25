<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssetResource\Pages;
use App\Filament\Resources\AssetResource\RelationManagers;
use App\Models\Asset;
use App\Models\Owner;
use Filament\Forms;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Closure;



class AssetResource extends Resource
{
    protected static ?string $model = Asset::class;

//    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';
    protected static ?string $navigationGroup = 'Assets Management';
    protected static ?string $navigationLabel = 'Electronic Devices';

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
                                TextInput::make('ram')
                                ->suffix('GB'),
                                TextInput::make('storage')
                                ->suffix('GB'),
                                Forms\Components\DatePicker::make('purchase_date'),
                                Forms\Components\DatePicker::make('warranty_expired'),

                                Forms\Components\Textarea::make('notes')
                                ->columnSpan('full')
                                ->rows('6'),

                            ])->columns(2),

                    ]),


                Forms\Components\Group::make()

                    ->schema([

                        Forms\Components\Section::make('Status')

                            ->schema([
                                Forms\Components\Select::make('condition')
                                    ->options([

                                        'Working' => 'Working',
                                        'Not Working' => 'Not Working',
                                    ]),

                            ]),
                        Forms\Components\Section::make('Receipt Image')

                            ->schema([

                                Forms\Components\FileUpload::make('purchase_receipt')
                                    ->image()
                                    ->imageEditor()
                                    ->openable()
                                    ->downloadable()
                                    ->columnSpan('full'),
                            ]),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
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
                Tables\Columns\TextColumn::make('owner.name')
                    ->getStateUsing(function (Model $record) {
                        $latestOwner = $record->owner()->latest()->first();

                        if ($latestOwner && $latestOwner->return_date !== null) {
                            return '-'; // Return an empty string if the latest owner has a return_date
                        }

                        return $latestOwner ? $latestOwner->name : ''; // Return the owner's name if available
                    })->searchable(),

                Tables\Columns\IconColumn::make('owner.availability')
                    ->label('Availability')
                        ->getStateUsing(function ($record) {
                            $latestOwner = $record->owner()->latest()->first();

                            if (!$latestOwner) {
                                return 'Available'; // No owner record, so it's available.
                            }

                            return $latestOwner->availability;
                        })


                    ->icon(fn (string $state): string => match ($state) {
                        'Not Available' => 'heroicon-o-x-circle',
                        'Available' => 'heroicon-o-check-circle',
                    })
                    ->colors([
                        'danger' => 'Not Available',
                        'success' => 'Available',
                    ]),
                Tables\Columns\IconColumn::make('condition')
                    ->icon(fn (string $state): string => match ($state) {
                        'Not Working' => 'heroicon-o-x-circle',
                        'Working' => 'heroicon-o-check-circle',
                    })
                    ->colors([
                        'danger' => 'Not Working',
                        'success' => 'Working',
                    ]),

            ])
            ->filters([
                SelectFilter::make('company')
                    ->searchable()
                    ->preload()
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
            RelationManagers\OwnerRelationManager::class,
            RelationManagers\RepairRelationManager::class,
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
