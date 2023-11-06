<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DomainResource\Pages;
use App\Filament\Resources\DomainResource\RelationManagers;
use App\Models\Domain;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Rawilk\FilamentPasswordInput\Password;

class DomainResource extends Resource
{
    protected static ?string $model = Domain::class;

    protected static ?string $navigationGroup = 'Hosting & Domain';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Domain Details')
                            ->schema([
                                Forms\Components\TextInput::make('domain_name')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Domain Name'))
                                    ->columnSpan('full'),
                                Forms\Components\DatePicker::make('purchase_date')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Purchase Date')),
                                Forms\Components\DatePicker::make('expiry_date')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Expiry Date')),
                                Forms\Components\Select::make('hosting_id')
                                    ->relationship('hosting', 'server_name')
                                    ->required()
                                    ->searchable()
                                    ->options(function () {
                                        return \App\Models\Hosting::all()->pluck('server_name', 'id');
                                    })->columnSpan('full'),
                            ])->columns(2),

                        Forms\Components\Section::make('Other Details')
                            ->schema([
                                Forms\Components\TextInput::make('client_id')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Client ID'))
                                    ->columnSpan('full'),

                            ]),
                    ]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Domain Status')
                            ->schema([
                                Forms\Components\Toggle::make('is_active')
                                    ->autofocus()
                                    ->required(),

                            ])->columns(2),

                        Forms\Components\Section::make('Registrar Details')
                            ->schema([
                                Forms\Components\TextInput::make('domain_provider')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Domain Provider'))
                                    ->columnSpan('full'),
                                Forms\Components\TextInput::make('domain_provider_url')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Domain Provider URL'))
                                    ->columnSpan('full'),
                                Forms\Components\TextInput::make('domain_provider_username')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Domain Provider Username')),
                                Password::make('domain_provider_password')
                                    ->showPasswordText('Show password')
                                    ->hidePasswordText('Hide password')
                                    ->copyable()
                                    ->copyIcon('heroicon-s-clipboard')
                                    ->copyTooltip('Copy password')
                                    ->copyMessage('Copied')
                                    ->password()
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Domain Provider Password')),
                            ])->columns(2),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('domain_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('expiry_date')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('hosting.server_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BooleanColumn::make('is_active')
                    ->label(__('Active'))
                    ->sortable(),

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
            'index' => Pages\ListDomains::route('/'),
            'create' => Pages\CreateDomain::route('/create'),
            'edit' => Pages\EditDomain::route('/{record}/edit'),
        ];
    }
}
