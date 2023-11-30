<?php

namespace App\Filament\Resources\LaptopResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LaptopRepairRelationManager extends RelationManager
{
    protected static string $relationship = 'LaptopRepair';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('company')
                    ->required()
                    ->columnSpan('full'),
                Forms\Components\DatePicker::make('send_date')
                    ->required(),
                Forms\Components\DatePicker::make('pickup_date')
                    ->required(),
                Forms\Components\TextInput::make('repair_cost')
                    ->required(),
                Forms\Components\TextInput::make('send_by')
                    ->required(),
                Forms\Components\FileUpload::make('payment_receipt')
                    ->image()
                    ->openable()
                    ->downloadable()
                    ->required(),
                Forms\Components\Textarea::make('note')
                    ->nullable()
                    ->rows('3'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('company')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('send_date')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('pickup_date')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('repair_cost')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('send_by')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
