<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OtherBillResource\Pages;
use App\Filament\Resources\OtherBillResource\RelationManagers;
use App\Models\OtherBill;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OtherBillResource extends Resource
{
    protected static ?string $model = OtherBill::class;

    protected static ?string $navigationGroup = 'Bills Management';

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
                                    ])
                                    ->required(),

                                Forms\Components\Select::make('year')
                                    ->options([
                                        '2022' => '2022',
                                        '2023' => '2023',
                                        '2024' => '2024',
                                        '2025' => '2025',
                                        '2026' => '2026',
                                        '2027' => '2027',
                                        '2028' => '2028',
                                        '2029' => '2029',
                                        '2030' => '2030',
                                        '2031' => '2031',
                                        '2032' => '2032',
                                        '2033' => '2033',
                                        '2034' => '2034',
                                        '2035' => '2035',
                                    ])
                                    ->required(),

                                Forms\Components\TextInput::make('amount')
                                    ->required(),

                                Forms\Components\Select::make('payment_status')
                                    ->options([
                                        'unpaid' => 'Unpaid',
                                        'partial' => 'Partial',
                                        'paid' => 'Paid',
                                    ]),

                                Forms\Components\FileUpload::make('bill_image')
                                    ->image()
                                    ->imageEditor()
                                    ->openable()
                                    ->downloadable()
                                    ->columnSpan('full'),



                            ])->columns(2),




                    ]),

                Forms\Components\Group::make()

                    ->schema([

                        Forms\Components\Section::make('Payment Details')

                            ->schema([

                                Forms\Components\TextInput::make('paid_amount'),

                                Forms\Components\DatePicker::make('payment_date'),

                                Forms\Components\FileUpload::make('payment_slip')
                                    ->image()
                                    ->imageEditor()
                                    ->openable()
                                    ->downloadable(),


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
                TextColumn::make('month')
                    ->searchable(),
                TextColumn::make('year'),
                TextColumn::make('amount')
                    ->money('MYR'),
                TextColumn::make('payment_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'unpaid' => 'danger',
                        'paid' => 'success',
                        'partial' => 'warning',
                    }),
                TextColumn::make('paid_amount')
                    ->money('MYR')
                    ->placeholder('MYR 0.00'),
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
            'index' => Pages\ListOtherBills::route('/'),
            'create' => Pages\CreateOtherBill::route('/create'),
            'edit' => Pages\EditOtherBill::route('/{record}/edit'),
        ];
    }
}
