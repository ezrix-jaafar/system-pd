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
                                Forms\Components\TextInput::make('project_status')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Project Status')),
                                Forms\Components\DatePicker::make('date')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Date')),
                                Forms\Components\TextInput::make('client_id')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Client ID')),
                                Forms\Components\TextInput::make('salesperson_id')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Salesperson ID')),
                                Forms\Components\TextInput::make('person_in_charge_id')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Person In Charge ID')),
                                Forms\Components\TextInput::make('coordinator_id')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Coordinator ID')),

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
            'index' => Pages\ListWebsiteProjects::route('/'),
            'create' => Pages\CreateWebsiteProject::route('/create'),
            'edit' => Pages\EditWebsiteProject::route('/{record}/edit'),
        ];
    }
}
