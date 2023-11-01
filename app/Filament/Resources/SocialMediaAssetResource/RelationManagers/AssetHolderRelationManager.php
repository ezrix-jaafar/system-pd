<?php

namespace App\Filament\Resources\SocialMediaAssetResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AssetHolderRelationManager extends RelationManager
{
    protected static string $relationship = 'AssetHolder';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('staff_id')
                    ->relationship('staff', 'name')
                    ->required()
                    ->searchable()
                    ->options(function () {
                        return \App\Models\Staff::all()->pluck('name', 'id');
                    })->columnSpan('full'),
                Forms\Components\DatePicker::make('received_date'),
                Forms\Components\DatePicker::make('return_date'),
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
                Tables\Columns\TextColumn::make('staff.name'),
                Tables\Columns\TextColumn::make('received_date'),
                Tables\Columns\TextColumn::make('return_date'),
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
