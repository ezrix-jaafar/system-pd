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

class LaptopOwnerRelationManager extends RelationManager
{
    protected static string $relationship = 'LaptopOwner';

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
                Tables\Columns\TextColumn::make('Recorder.name')
                    ->label('Recorded By')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['recorder_id'] = auth()->id();

                        return $data;
                    }),
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
            ])->defaultSort('created_at', 'desc');
    }
}
