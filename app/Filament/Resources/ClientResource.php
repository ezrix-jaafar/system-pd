<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
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
use Illuminate\Validation\Rules\Enum;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationGroup = 'Clients Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Group::make()

                    ->schema([

                        Forms\Components\Section::make('Client Details')

                            ->schema([

                                Forms\Components\TextInput::make('name')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Name'))
                                    ->columnSpan('full'),
                                Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->placeholder(__('Email')),
                                Forms\Components\TextInput::make('phone')
                                    ->required()
                                    ->placeholder(__('Phone')),
                                Forms\Components\TextInput::make('company')
                                    ->nullable()
                                    ->placeholder(__('Company')),
                                Forms\Components\TextInput::make('designation')
                                    ->nullable()
                                    ->placeholder(__('Designation')),
                                Forms\Components\FileUpload::make('name_card')
                                    ->image()
                                    ->imageEditor()
                                    ->openable()
                                    ->columnSpan('full'),

                            ])->columns(2),
                    ]),

                Forms\Components\Group::make()

                    ->schema([
                        Forms\Components\Section::make('Client Address')

                            ->schema([
                                Forms\Components\Textarea::make('address')
                                    ->nullable()
                                    ->placeholder(__('Address'))
                                    ->columnSpan('full')
                                    ->rows(5),
                                Forms\Components\TextInput::make('city')
                                    ->nullable()
                                    ->placeholder(__('City')),
                                Forms\Components\TextInput::make('postcode')
                                    ->nullable()
                                    ->placeholder(__('Postcode')),
                                Forms\Components\Select::make('state')
                                    ->options([
                                        'Johor' => 'Johor',
                                        'Kedah' => 'Kedah',
                                        'Kelantan' => 'Kelantan',
                                        'Kuala Lumpur' => 'Kuala Lumpur',
                                        'Labuan' => 'Labuan',
                                        'Melaka' => 'Melaka',
                                        'Negeri Sembilan' => 'Negeri Sembilan',
                                        'Pahang' => 'Pahang',
                                        'Perak' => 'Perak',
                                        'Perlis' => 'Perlis',
                                        'Pulau Pinang' => 'Pulau Pinang',
                                        'Putrajaya' => 'Putrajaya',
                                        'Sabah' => 'Sabah',
                                        'Sarawak' => 'Sarawak',
                                        'Selangor' => 'Selangor',
                                        'Terengganu' => 'Terengganu',
                                    ])
                                    ->searchable(),
                                Forms\Components\TextInput::make('country')
                                    ->required()
                                    ->default('Malaysia'),

                            ])->columns(2),

                            Forms\Components\Section::make()
                                ->schema([
                                    Forms\Components\Textarea::make('note')
                                        ->nullable()
                                        ->placeholder(__('Note'))
                                        ->columnSpan('full'),
                                    ]),



                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('company')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('designation')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('state')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
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
            RelationManagers\AdsProjectRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
