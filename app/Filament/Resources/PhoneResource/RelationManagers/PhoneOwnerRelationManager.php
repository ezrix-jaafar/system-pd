<?php

namespace App\Filament\Resources\PhoneResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PhoneOwnerRelationManager extends RelationManager
{
    protected static string $relationship = 'PhoneOwner';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('availability')
                    ->options([
                        'Available' => 'Available',
                        'Not Available' => 'Not Available',
                    ])
                    ->disabled(),
                Forms\Components\DatePicker::make('received_date'),
                Forms\Components\DatePicker::make('return_date')
                    ->reactive()
                    ->live(onBlur: true),
//                ->afterStateUpdated(fn (Get $get) => $get('availability') !== 'Not Available'),
                Forms\Components\Textarea::make('note'),
                Forms\Components\FileUpload::make('acceptance_letter')
                    ->image()
                    ->openable()
                    ->downloadable(),


            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
