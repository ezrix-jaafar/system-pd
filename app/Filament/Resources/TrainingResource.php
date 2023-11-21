<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainingResource\Pages;
use App\Filament\Resources\TrainingResource\RelationManagers;
use App\Models\Training;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrainingResource extends Resource
{
    protected static ?string $model = Training::class;

    protected static ?string $navigationGroup = 'Training Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Training Details')
                            ->schema([
                                Forms\Components\TextInput::make('training_name')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Training Name'))
                                    ->columnSpan('full'),
                                Forms\Components\TextInput::make('training_provider')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Training Provider'))
                                    ->columnSpan('full'),
                                Forms\Components\TextInput::make('training_location')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Training Location'))
                                    ->columnSpan('full'),
                                Forms\Components\Select::make('training_attendees')
                                    ->searchable()
                                    ->options(function () {
                                        return \App\Models\Staff::all()->pluck('name', 'id');
                                    })
                                    ->required()
                                    ->placeholder(__('Training Attendees'))
                                    ->multiple()
                                    ->columnSpan('full'),
                            ])->columns(2),
                    ]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Date & Fees')
                            ->schema([
                                Forms\Components\DatePicker::make('training_start_date')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Training Start Date')),
                                Forms\Components\DatePicker::make('training_end_date')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Training End Date')),
                                Forms\Components\Select::make('training_type')
                                    ->options([
                                        'Online' => 'Online',
                                        'On-Site' => 'On-Site',
                                    ])
                                    ->required()
                                    ->placeholder(__('Training Type')),
                                Forms\Components\TextInput::make('training_fees')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Training Fees')),
                                Forms\Components\Textarea::make('training_remarks')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Training Remarks'))
                                    ->rows(4)
                                    ->columnSpan('full'),
                            ])->columns(2),
                    ])
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
            'index' => Pages\ListTrainings::route('/'),
            'create' => Pages\CreateTraining::route('/create'),
            'edit' => Pages\EditTraining::route('/{record}/edit'),
        ];
    }
}
