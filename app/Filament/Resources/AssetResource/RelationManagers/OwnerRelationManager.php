<?php

namespace App\Filament\Resources\AssetResource\RelationManagers;

use App\Models\Owner;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Closure;

class OwnerRelationManager extends RelationManager
{
    protected static string $relationship = 'owner';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
//                Forms\Components\TextInput::make('id')
//                    ->required()
//                    ->maxLength(255),

                Forms\Components\TextInput::make('name')
                ->columnSpan('full'),
                Forms\Components\DatePicker::make('received_date'),
                Forms\Components\DatePicker::make('return_date')
                ->reactive(),
                TextInput::make('availability'),
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
//                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name'),
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
    public function create($data)
    {
        $owner = new Owner();
        $owner->store($data);
    }

    public function update($record, $data)
    {
        $record->update($data);
    }
}
