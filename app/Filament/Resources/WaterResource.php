<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WaterResource\Pages;
use App\Filament\Resources\WaterResource\RelationManagers;
use App\Models\Water;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WaterResource extends Resource
{
    protected static ?string $model = Water::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Bills';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()

                ->schema([

                    Forms\Components\Section::make("Bill Details")

                    ->schema([

                        Forms\Components\Select::make('month')
                        ->options([
                            'January' => 'January',
                            'February' => 'February',
                            'March' => 'March',
                            'April' => 'April',
                            'May' => 'May',
                            'June' => 'June',
                            'July' => 'July',
                            'August' => 'August',
                            'September' => 'September',
                            'October' => 'October',
                            'November' => 'November',
                            'December' => 'December',
                        ]),

                        Forms\Components\TextInput::make('amount'),

                        Forms\Components\Select::make('payment_status')
                        ->options([
                            'unpaid' => 'Unpaid',
                            'partial' => 'Partial',
                            'paid' => 'Paid',
                        ])
                        ->columnSpan('full'),

                        Forms\Components\FileUpload::make('bill_image')
                        ->columnSpan('full'),



                    ])->columns(2),




                ]),

                Forms\Components\Group::make()

                ->schema([



                    Forms\Components\Section::make('Payment Details')

                    ->schema([

                    Forms\Components\TextInput::make('paid_amount'),

                    Forms\Components\DatePicker::make('payment_date'),

                    Forms\Components\FileUpload::make('payment_slip'),


                    ]),




                ]),



                    Forms\Components\Section::make()

                    ->schema([

                        Forms\Components\Textarea::make('note')
                        ->rows(6)


                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('month'),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('payment_status'),
                Tables\Columns\TextColumn::make('paid_amount'),

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
            'index' => Pages\ListWaters::route('/'),
            'create' => Pages\CreateWater::route('/create'),
            'edit' => Pages\EditWater::route('/{record}/edit'),
        ];
    }
}
