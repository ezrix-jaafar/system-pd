<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LaptopResource\Pages;
use App\Filament\Resources\LaptopResource\RelationManagers;
use App\Models\Laptop;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LaptopResource extends Resource
{
    protected static ?string $model = Laptop::class;

    protected static ?string $navigationGroup = 'Assets Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()

                    ->schema([

                        Forms\Components\Section::make('Phone Details')

                            ->schema([

                                TextInput::make('brand'),
                                TextInput::make('model'),
                                TextInput::make('serial_number')
                                    ->columnSpan('full'),
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
                                    ->hiddenLabel()
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
            ->columns([
                Tables\Columns\TextColumn::make('brand'),
                Tables\Columns\TextColumn::make('ram')
                    ->suffix('GB'),
                Tables\Columns\TextColumn::make('storage')
                    ->suffix('GB'),
                Tables\Columns\TextColumn::make('laptop_owner.user_id')
                    ->getStateUsing(function (Model $record) {
                        $latestOwner = $record->LaptopOwner()->latest()->first();

                        return $latestOwner ? $latestOwner->user->name : ''; // Return the owner's name if available
                    })->searchable(),

                Tables\Columns\IconColumn::make('LaptopOwner.record_type')
                    ->label('Availability')
                    ->getStateUsing(function (Model $record) {
                        $latestOwner = $record->LaptopOwner()->latest()->first();

                        return $latestOwner ? $latestOwner->record_type : ''; // Return the owner's name if available
                    })

                    ->icon(fn (string $state): string => match ($state) {
                        'Collect' => 'heroicon-o-x-circle',
                        'Return' => 'heroicon-o-check-circle',
                    })
                    ->colors([
                        'danger' => 'Collect',
                        'success' => 'Return',
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
            RelationManagers\LaptopOwnerRelationManager::class,
            RelationManagers\LaptopRepairRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLaptops::route('/'),
            'create' => Pages\CreateLaptop::route('/create'),
            'edit' => Pages\EditLaptop::route('/{record}/edit'),
        ];
    }
}
