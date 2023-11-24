<?php

namespace App\Filament\Resources\TrainingResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\LinkAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrainingReportRelationManager extends RelationManager
{
    protected static string $relationship = 'trainingReport';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Training Report')
                            ->schema([
//                                Forms\Components\TextInput::make('user_id')
//                                    ->autofocus()
//                                    ->readOnly()
//                                    ->hidden()
//                                    ->default(auth()->id())
//                                    ->columnSpan('full'),
                                Forms\Components\RichEditor::make('training_report')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Training Report'))
                                    ->columnSpan('full'),
                                Forms\Components\FileUpload::make('training_attachment')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Training Attachment'))
                                    ->columnSpan('full'),
                            ])
                    ]),
            ])

            ->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['user_id'] = auth()->id();

                        return $data;
                    })

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



//    protected function getTableActions(): array
//    {
//        return [
//            LinkAction::make('create')
//                ->url(fn ($record): string => route('filament.resources.trainingReport.create', ['record' => $record]))
//                ->icon('heroicon-s-pencil'),
//
//        ];
//    }
}
