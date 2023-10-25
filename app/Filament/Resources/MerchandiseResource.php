<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MerchandiseResource\Pages;
use App\Filament\Resources\MerchandiseResource\RelationManagers;
use App\Models\Merchandise;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;

class MerchandiseResource extends Resource
{
    protected static ?string $model = Merchandise::class;

//    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = 'Products';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()

                    ->schema([

                        Forms\Components\Section::make('Product Details')

                            ->schema([


                                Forms\Components\TextInput::make('product_name'),

                                Forms\Components\MarkdownEditor::make('product_description'),

                                Forms\Components\TextInput::make('sales_page')
                                    ->prefixIcon('heroicon-m-globe-alt')
                                    ->url(),

                                FileUpload::make('product_image')
                                    ->image()
                                    ->imageEditor()
                                    ->openable()

                            ]),

                    ]),


                Forms\Components\Group::make()

                    ->schema([

                        Forms\Components\Section::make('Product Variations')

                            ->schema([


                                Repeater::make('variations')
                                    ->schema([
                                        TextInput::make('variation_name')->required()
                                        ->columnSpan('full'),
                                        TextInput::make('price')->required(),
                                        TextInput::make('stock')->required(),

                                    ])
                                    ->columns(2)




                            ]),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                TextColumn::make('product_name')
                    ->searchable(),

                TextColumn::make('sales_page')
                    ->icon('heroicon-o-link')
                    ->url(function ($record) {
                        return url($record->sales_page);
                    }),
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
            'index' => Pages\ListMerchandises::route('/'),
            'create' => Pages\CreateMerchandise::route('/create'),
            'edit' => Pages\EditMerchandise::route('/{record}/edit'),
        ];
    }
}
