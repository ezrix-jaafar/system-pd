<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DailyWorkingReportOperationResource\Pages;
use App\Filament\Resources\DailyWorkingReportOperationResource\RelationManagers;
use App\Models\DailyWorkingReportOperation;
use Filament\Actions\ActionGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DailyWorkingReportOperationResource extends Resource
{
    protected static ?string $model = DailyWorkingReportOperation::class;

    protected static ?string $navigationGroup = 'Daily Report';
    protected static ?string $label = 'Daily Report Team Operation';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Working Report')
                            ->schema([
                                Forms\Components\TextInput::make('user_id')
                                    ->default(auth()->id())
                                    ->readOnly(),
                                Forms\Components\DatePicker::make('report_date')
                                    ->required(),
                                Forms\Components\Textarea::make('Notes')
                                    ->rows('5'),

                            ])
                    ]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Progress Report')
                            ->schema([
                                Forms\Components\Repeater::make('report_details')
                                    ->collapsible()
                                    ->hiddenLabel()
                                    ->schema([
                                        Forms\Components\TextInput::make('project_name'),
                                        Forms\Components\Select::make('progress')
                                            ->searchable()
                                            ->options([
                                                '10%' => '10%',
                                                '20%' => '20%',
                                                '30%' => '30%',
                                                '40%' => '40%',
                                                '50%' => '50%',
                                                '60%' => '60%',
                                                '70%' => '70%',
                                                '80%' => '80%',
                                                '90%' => '90%',
                                                '100%' => '100%',
                                            ]),
                                        Forms\Components\Textarea::make('client_note')
                                            ->columnSpan('full')
                                            ->rows('1')
                                            ->autosize(),
                                    ])->addActionLabel('Add more client') ->columns('2')
                            ])
                    ])
            ])->columns('full');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('report_date')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('report_details_count')
                    ->label('Total Client Contacted')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ctionGroup::make([
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDailyWorkingReportOperations::route('/'),
            'create' => Pages\CreateDailyWorkingReportOperation::route('/create'),
            'edit' => Pages\EditDailyWorkingReportOperation::route('/{record}/edit'),
        ];
    }
}
