<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdsProjectResource\Pages;
use App\Filament\Resources\AdsProjectResource\RelationManagers;
use App\Models\AdsProject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdsProjectResource extends Resource
{
    protected static ?string $model = AdsProject::class;

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
                                Forms\Components\TextInput::make('project_link')
                                    ->required()
                                    ->placeholder(__('Project Link')),
                                Forms\Components\TextInput::make('daily_budget')
                                    ->required()
                                    ->placeholder(__('Daily Budget')),
                                Forms\Components\TextInput::make('total_spend')
                                    ->required()
                                    ->placeholder(__('Total Spend')),
                                Forms\Components\Datepicker::make('start_date')
                                    ->required()
                                    ->placeholder(__('Start Date')),
                                Forms\Components\Datepicker::make('end_date')
                                    ->required()
                                    ->placeholder(__('End Date')),
                                Forms\Components\TextInput::make('total_days')
                                    ->required()
                                    ->placeholder(__('Total Days')),
                                Forms\Components\Textarea::make('project_description')
                                    ->required()
                                    ->placeholder(__('Project Description'))
                                    ->columnSpan('full')
                                    ->rows(5),
                                Forms\Components\FileUpload::make('report_image')
                                    ->image()
                                    ->multiple()
                                    ->imageEditor()
                                    ->openable()
                                    ->columnSpan('full'),
                            ])
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
            'index' => Pages\ListAdsProjects::route('/'),
            'create' => Pages\CreateAdsProject::route('/create'),
            'edit' => Pages\EditAdsProject::route('/{record}/edit'),
        ];
    }
}
