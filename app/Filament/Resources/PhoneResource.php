<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhoneResource\Pages;
use App\Filament\Resources\PhoneResource\RelationManagers;
use App\Models\Phone;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PhoneResource extends Resource
{
    protected static ?string $model = Phone::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
            RelationManagers\PhoneOwnerRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPhones::route('/'),
            'create' => Pages\CreatePhone::route('/create'),
            'edit' => Pages\EditPhone::route('/{record}/edit'),
        ];
    }
}
