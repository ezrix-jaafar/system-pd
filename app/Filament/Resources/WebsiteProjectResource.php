<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WebsiteProjectResource\Pages;
use App\Filament\Resources\WebsiteProjectResource\RelationManagers;
use App\Models\WebsiteProject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WebsiteProjectResource extends Resource
{
    protected static ?string $model = WebsiteProject::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Project Details')
                            ->schema([
                                Forms\Components\TextInput::make('project_name')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Project Name'))
                                    ->columnSpan('full'),
                                Forms\Components\Select::make('project_status')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Project Status'))
                                    ->options([
                                        'Domain Pending' => 'Domain Pending',
                                        'Domain Locked' => 'Domain Locked',
                                        'Domain Purchased' => 'Domain Purchased',
                                        'Work In Progress' => 'Work In Progress',
                                        'Done' => 'Done',
                                        'Cancel' => 'Cancel',
                                    ]),
                                Forms\Components\DatePicker::make('date')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Date')),
                                Forms\Components\Select::make('client_id')
                                    ->relationship('client', 'name')
                                    ->required()
                                    ->searchable()
                                    ->options(function () {
                                        return \App\Models\Client::all()->pluck('name', 'id');
                                    }),
                                Forms\Components\Select::make('person_in_charge_id')
                                    ->relationship('personInCharge')
                                    ->required()
                                    ->searchable()
                                    ->label('Person In Charge')
                                    ->options(function () {
                                        return \App\Models\Staff::all()->pluck('name', 'id');
                                    }),
                                Forms\Components\Select::make('salesperson_id')
                                    ->relationship('salesperson')
                                    ->required()
                                    ->searchable()
                                    ->label('Sales Person')
                                    ->options(function () {
                                        return \App\Models\Staff::all()->pluck('name', 'id');
                                    }),
                                Forms\Components\Select::make('coordinator_id')
                                    ->relationship('coordinator')
                                    ->required()
                                    ->searchable()
                                    ->label('Project Coordinator')
                                    ->options(function () {
                                        return \App\Models\Staff::all()->pluck('name', 'id');
                                    }),

                            ])->columns(2),
                    ]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Project Details')
                            ->schema([
                                Forms\Components\RichEditor::make('project_description')
                                    ->hiddenLabel()
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Project Description')),

                            ]),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project_name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\SelectColumn::make('project_status')
                    ->sortable()
                    ->searchable()
                    ->options([
                        'Domain Pending' => 'Domain Pending',
                        'Domain Locked' => 'Domain Locked',
                        'Domain Purchased' => 'Domain Purchased',
                        'Work In Progress' => 'Work In Progress',
                        'Done' => 'Done',
                        'Cancel' => 'Cancel',
                    ]),
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
            'index' => Pages\ListWebsiteProjects::route('/'),
            'create' => Pages\CreateWebsiteProject::route('/create'),
            'edit' => Pages\EditWebsiteProject::route('/{record}/edit'),
        ];
    }
}
