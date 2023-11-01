<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdsProjectResource\Pages;
use App\Filament\Resources\AdsProjectResource\RelationManagers;
use App\Models\AdsProject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdsProjectResource extends Resource
{
    protected static ?string $model = AdsProject::class;

//    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Projects Management';
    protected static ?string $navigationLabel = 'Ads Projects';

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
                                Forms\Components\Select::make('client_id')
                                    ->relationship('client', 'name')
                                    ->required()
                                    ->searchable()
                                    ->options(function () {
                                    return \App\Models\Client::all()->pluck('name', 'id');
                                    })->columnSpan('full'),
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
                                Forms\Components\Select::make('project_type')
                                    ->options([
                                        'Google Ads' => 'Google Ads',
                                        'Facebook Ads' => 'Facebook Ads',
                                        'LinkedIn Ads' => 'LinkedIn Ads',
                                        'TikTok Ads' => 'TikTok Ads',
                                        'Shopee Ads' => 'Shopee Ads',
                                    ])
                                    ->required(),
                                Forms\Components\Select::make('project_status')
                                    ->options([
                                        'New' => 'New',
                                        'Active' => 'Active',
                                        'On Hold' => 'On Hold',
                                        'Ended' => 'Ended',
                                        'Renew Active' => 'Renew Active',
                                        'Renew On Hold' => 'Renew On Hold',
                                        'Renew Ended' => 'Renew Ended',
                                    ])
                                    ->required(),
                                Forms\Components\RichEditor::make('project_description')
                                    ->required()
                                    ->placeholder(__('Project Description'))
                                    ->columnSpan('full')
                                    ->disableToolbarButtons([
                                        'blockquote',
                                        'undo',
                                        'redo',
                                    ]),

                            ])->columns(2)
                    ]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Budget & Timeline')
                            ->schema([

                                Forms\Components\TextInput::make('project_link')
                                    ->required()
                                    ->placeholder(__('Project Link')),
                                Forms\Components\TextInput::make('total_days')
                                    ->disabled()
                                    ->placeholder(function ($get) {
                                        $startDate = $get('start_date');
                                        $endDate = $get('end_date');

                                        if ($startDate && $endDate) {
                                            $start = new \DateTime($startDate);
                                            $end = new \DateTime($endDate);
                                            $interval = $start->diff($end);

                                            return $interval->days + 1; // Adding 1 to include both start and end dates
                                        }

                                        return null;
                                    }),
                                Forms\Components\TextInput::make('daily_budget')
                                    ->numeric()
                                    ->inputMode('decimal')
                                    ->required()
                                    ->placeholder(__('Daily Budget')),
                                Forms\Components\TextInput::make('total_spend')
                                    ->numeric()
                                    ->inputMode('decimal')
                                    ->required()
                                    ->placeholder(__('Total Spend')),
                                Forms\Components\Datepicker::make('start_date')
                                    ->required()
                                    ->reactive()
                                    ->placeholder(__('Start Date')),
                                Forms\Components\Datepicker::make('end_date')
                                    ->required()
                                    ->reactive()
                                    ->placeholder(__('End Date')),
                            ])->columns(),
                        Forms\Components\Section::make('Report Image')
                            ->schema([
                                Forms\Components\FileUpload::make('report_image')
                                    ->image()
                                    ->multiple()
                                    ->imageEditor()
                                    ->openable()
                                    ->downloadable()
                                    ->reorderable()
                                    ->columnSpan('full'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('client.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('project_type')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Google Ads' => 'danger',
                        'Facebook Ads' => 'info',
                        'LinkedIn Ads' => 'success',
                        'TikTok Ads' => 'gray',
                        'Shopee Ads' => 'warning',

                    }),
                Tables\Columns\TextColumn::make('project_status')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'New' => 'gray',
                        'Active' => 'secondary',
                        'On Hold' => 'success',
                        'Ended' => 'warning',
                        'Renew Active' => 'danger',
                        'Renew On Hold' => 'primary',
                        'Renew Ended' => 'secondary',

                    }),
                Tables\Columns\TextColumn::make('salesperson.name')
                    ->label('Sales Person')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('personInCharge.name')
                    ->label('Person In Charge')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_spend')
                    ->prefix('RM')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdsProjects::route('/'),
            'create' => Pages\CreateAdsProject::route('/create'),
            'edit' => Pages\EditAdsProject::route('/{record}/edit'),
        ];
    }
}
