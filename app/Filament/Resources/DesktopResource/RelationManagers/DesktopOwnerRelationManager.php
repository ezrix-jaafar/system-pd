<?php

namespace App\Filament\Resources\DesktopResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DesktopOwnerRelationManager extends RelationManager
{
    protected static string $relationship = 'DesktopOwner';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('record_type')
                    ->options([
                        'Collect' => 'Collect',
                        'Return' => 'Return',
                    ]),
                Forms\Components\Select::make('user_id')
                    ->relationship('User', 'name')
                    ->required()
                    ->searchable()
                    ->options(function () {
                        return \App\Models\User::all()->pluck('name', 'id');
                    }),
                Forms\Components\DatePicker::make('record_date')
                    ->required(),
                Forms\Components\FileUpload::make('record_letter')
                    ->label('Acceptance/Return Letter')
                    ->image()
                    ->openable()
                    ->downloadable()
                    ->columnSpan('full'),
                Forms\Components\RichEditor::make('note')
                    ->columnSpan('full'),
            ])->columns('3');
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('record_type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Collect' => 'success',
                        'Return' => 'danger',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'Collect' => 'heroicon-o-arrow-up-circle',
                        'Return' => 'heroicon-o-arrow-down-circle',
                    }),
                Tables\Columns\TextColumn::make('User.name'),
                Tables\Columns\TextColumn::make('record_date'),
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
