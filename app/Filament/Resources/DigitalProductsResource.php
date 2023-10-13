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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;

class DigitalProductsResource extends Resource
{
    protected static ?string $model = DigitalProducts::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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

                    Forms\Components\TextInput::make('file_location')
                    ->prefixIcon('heroicon-m-globe-alt')
                    ->url(),

                    Forms\Components\TextInput::make('sales_page')
                    ->prefixIcon('heroicon-m-globe-alt')
                    ->url(),

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
            ->striped()
            ->columns([
                TextColumn::make('product_name')
                    ->searchable(),

                TextColumn::make('file_location')
                ->icon('heroicon-m-link')
                ->url(function ($record) {
                    return url($record->file_location);
                }),

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
            'index' => Pages\ListDigitalProducts::route('/'),
            'create' => Pages\CreateDigitalProducts::route('/create'),
            'edit' => Pages\EditDigitalProducts::route('/{record}/edit'),
        ];
    }
}
