<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DesktopResource\Pages;
use App\Filament\Resources\DesktopResource\RelationManagers;
use App\Models\Desktop;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DesktopResource extends Resource
{
    protected static ?string $model = Desktop::class;

    protected static ?string $navigationGroup = 'Assets Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()

                    ->schema([

                        Forms\Components\Section::make('Desktop Details')

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
                Tables\Columns\TextColumn::make('desktop_owner.user_id')
                    ->getStateUsing(function (Model $record) {
                        $latestOwner = $record->DesktopOwner()->latest()->first();

                        return $latestOwner ? $latestOwner->user->name : ''; // Return the owner's name if available
                    })->searchable(),

                Tables\Columns\IconColumn::make('DesktopOwner.record_type')
                    ->label('Availability')
                    ->getStateUsing(function (Model $record) {
                        $latestOwner = $record->DesktopOwner()->latest()->first();

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
            RelationManagers\DesktopOwnerRelationManager::class,
            RelationManagers\DesktopRepairRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDesktops::route('/'),
            'create' => Pages\CreateDesktop::route('/create'),
            'edit' => Pages\EditDesktop::route('/{record}/edit'),
        ];
    }
}
