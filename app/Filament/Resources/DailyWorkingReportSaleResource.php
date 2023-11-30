<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DailyWorkingReportSaleResource\Pages;
use App\Filament\Resources\DailyWorkingReportSaleResource\RelationManagers;
use App\Models\DailyWorkingReportSale;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DailyWorkingReportSaleResource extends Resource
{
    protected static ?string $model = DailyWorkingReportSale::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Working Report')
                            ->schema([
                                Forms\Components\TextInput::make('user_id')
                                    ->default(auth()->user()->name)
                                    ->disabled(),
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
                                    ->schema([
                                        Forms\Components\TextInput::make('client_name')
                                        ->columnSpan('full'),
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
                                        Forms\Components\Select::make('status')
                                            ->searchable()
                                            ->options([
                                                'On Going' => 'On Going',
                                                'No Budget' => 'No Budget',
                                                'No Reply' => 'No Reply',
                                                'Rejected' => 'Rejected',
                                                'Done Payment' => 'Done Payment',
                                        ]),
                                        Forms\Components\Textarea::make('client_note')
                                            ->columnSpan('full')
                                            ->rows('3'),
                                    ])->columns('2')
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
            'index' => Pages\ListDailyWorkingReportSales::route('/'),
            'create' => Pages\CreateDailyWorkingReportSale::route('/create'),
            'edit' => Pages\EditDailyWorkingReportSale::route('/{record}/edit'),
        ];
    }
}
