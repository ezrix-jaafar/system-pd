<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ElectricityResource\Pages;
use App\Filament\Resources\ElectricityResource\RelationManagers;
use App\Models\Electricity;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Forms\FormsComponent;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Enums\MonthEnum; // Import MonthEnum
use App\Enums\YearEnum; // Import YearEnum
use Filament\Tables\Filters\SelectFilter;


class ElectricityResource extends Resource
{
    protected static ?string $model = Electricity::class;

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
                        ])
                        ->required(),

                        FileUpload::make('bill_image')
                        ->image()
                        ->imageEditor()
                        ->openable()
                        ->columnSpan('full'),



                    ])->columns(2),




                ]),

                Forms\Components\Group::make()

                ->schema([



                    Forms\Components\Section::make('Payment Details')

                    ->schema([

                    Forms\Components\TextInput::make('paid_amount'),

                    Forms\Components\DatePicker::make('payment_date'),

                    FileUpload::make('payment_slip')
                    ->image()
                    ->imageEditor(),


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
                    'unpaid' => 'warning',
                    'paid' => 'success',
                    'partial' => 'danger',
                }),
                TextColumn::make('paid_amount')
                ->money('MYR')
                ->placeholder('MYR 0.00'),

            ])
            ->filters([
                SelectFilter::make('payment_status')
                    ->multiple()
                    ->options([
                        'unpaind' => 'unpaid',
                        'partial' => 'partial',
                        'paid' => 'paid',
                ])
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
            'index' => Pages\ListElectricities::route('/'),
            'create' => Pages\CreateElectricity::route('/create'),
            'edit' => Pages\EditElectricity::route('/{record}/edit'),
        ];
    }


}
