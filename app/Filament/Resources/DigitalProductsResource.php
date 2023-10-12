<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DigitalProductsResource\Pages;
use App\Filament\Resources\DigitalProductsResource\RelationManagers;
use App\Models\DigitalProducts;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;

class DigitalProductsResource extends Resource
{
    protected static ?string $model = DigitalProducts::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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

                    Forms\Components\TextInput::make('file_location'),

                    Forms\Components\TextInput::make('sales_page'),


                    ]),

                ]),


                Forms\Components\Group::make()

                ->schema([

                    Forms\Components\Section::make('Product Variations')

                    ->schema([


                        Repeater::make('variations')
                            ->schema([
                                TextInput::make('variation_name')->required(),
                                TextInput::make('price')->required(),

                            ])
                            ->columns(2)




                    ]),

                ]),

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
            'index' => Pages\ListDigitalProducts::route('/'),
            'create' => Pages\CreateDigitalProducts::route('/create'),
            'edit' => Pages\EditDigitalProducts::route('/{record}/edit'),
        ];
    }
}
