<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdsCampaignResource\Pages;
use App\Filament\Resources\AdsCampaignResource\RelationManagers;
use App\Models\AdsCampaign;
use Faker\Provider\Text;
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

class AdsCampaignResource extends Resource
{
    protected static ?string $model = AdsCampaign::class;

    protected static ?string $navigationGroup = 'Marketing';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Ads Campaign Details')
                            ->schema([
                                Forms\Components\TextInput::make('campaign_name')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Campaign Name'))
                                    ->columnSpan('full'),
                                Forms\Components\Select::make('staff_id')
                                    ->relationship('staff', 'name')
                                    ->required()
                                    ->searchable()
                                    ->options(function () {
                                        return \App\Models\Staff::all()->pluck('name', 'id');
                                    })->columnSpan('full'),
                                Forms\Components\Select::make('campaign_platform')
                                    ->options([
                                        'Facebook Ads' => 'Facebook Ads',
                                        'Google Ads' => 'Google Ads',
                                        'LinkedIn Ads' => 'LinkedIn Ads',
                                        'TikTok Ads' => 'TikTok Ads',
                                        'Shopee Ads' => 'Shopee Ads',
                                    ])
                                    ->required(),
                                Forms\Components\Select::make('campaign_status')
                                    ->options([
                                        'New' => 'New',
                                        'Active' => 'Active',
                                        'On Hold' => 'On Hold',
                                        'Ended' => 'Ended',
                                    ])
                                    ->required(),
                                Forms\Components\TextInput::make('campaign_link')
                                    ->prefixIcon('heroicon-o-globe-alt')
                                    ->URL()
                                    ->placeholder(__('Campaign Link'))
                                    ->columnSpan('full'),
                                Forms\Components\RichEditor::make('campaign_description')
                                    ->placeholder(__('Campaign Description'))
                                    ->columnSpan('full')
                                    ->disableToolbarButtons([
                                        'blockquote',
                                        'undo',
                                        'redo']),
                            ])->columns('2'),

                    ]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Budget & Timeline')
                            ->schema([

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
                                    })->columnSpan('full'),
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
                                    ->hiddenLabel()
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
                Tables\Columns\TextColumn::make('campaign_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('campaign_platform')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Google Ads' => 'primary',
                        'Facebook Ads' => 'secondary',
                        'LinkedIn Ads' => 'success',
                        'TikTok Ads' => 'warning',
                        'Shopee Ads' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('campaign_status')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'New' => 'primary',
                        'Active' => 'secondary',
                        'On Hold' => 'success',
                        'Ended' => 'warning',
                    }),
                Tables\Columns\TextColumn::make('staff.name')
                    ->label('Staff')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_spend')
                    ->prefix('RM')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                \Filament\Tables\Actions\ActionGroup::make([
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
            'index' => Pages\ListAdsCampaigns::route('/'),
            'create' => Pages\CreateAdsCampaign::route('/create'),
            'edit' => Pages\EditAdsCampaign::route('/{record}/edit'),
        ];
    }
}
