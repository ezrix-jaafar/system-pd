<?php

namespace App\Filament\Resources\HostingProviderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Rawilk\FilamentPasswordInput\Password;

class HostingRelationManager extends RelationManager
{
    protected static string $relationship = 'Hosting';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Hosting Details')
                            ->schema([
                                Forms\Components\TextInput::make('server_name')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Server Name'))
                                    ->columnSpan('full'),
                                Forms\Components\TextInput::make('domain_name')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Domain Name'))
                                    ->columnSpan('full'),
                                Forms\Components\TextInput::make('package_name')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Package Name')),
                                Forms\Components\TextInput::make('server_cost')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Server Cost')),
                                Forms\Components\DatePicker::make('purchase_date')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Purchase Date')),
                                Forms\Components\DatePicker::make('expiry_date')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Expiry Date')),
                                Forms\Components\Select::make('hosting_provider_id')
                                    ->searchable()
                                    ->relationship(name: 'HostingProvider', titleAttribute: 'hosting_provider_id')
                                    ->options(function () {
                                        return \App\Models\HostingProvider::all()->pluck('hosting_company', 'id');
                                    })
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('hosting_company')
                                            ->unique()
                                            ->required(),
                                        Forms\Components\TextInput::make('website')
                                            ->unique()
                                            ->required(),
                                    ])->columns(2)
                                    ->columnSpan('full'),
                                Forms\Components\TextInput::make('client_dashboard_url')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Client Dashboard URL'))
                                    ->columnSpan('full'),
                                Forms\Components\TextInput::make('dashboard_username')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Dashboard Username')),
                                Password::make('dashboard_password')
                                    ->showPasswordText('Show password')
                                    ->hidePasswordText('Hide password')
                                    ->copyable()
                                    ->copyIcon('heroicon-s-clipboard')
                                    ->copyTooltip('Copy password')
                                    ->copyMessage('Copied')
                                    ->password()
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Dashboard Password')),
                            ])->columns(2),
                    ]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Technical Details')
                            ->schema([
                                Forms\Components\TextInput::make('nameserver_1')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Nameserver 1'))
                                    ->columnSpan('full'),
                                Forms\Components\TextInput::make('nameserver_2')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Nameserver 2'))
                                    ->columnSpan('full'),
                                Forms\Components\TextInput::make('ip_address')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('IP Address'))
                                    ->columnSpan('full'),
                                Forms\Components\TextInput::make('cpanel_url')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Cpanel URL'))
                                    ->columnSpan('full'),
                                Forms\Components\TextInput::make('cpanel_username')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Cpanel Username')),
                                Password::make('cpanel_password')
                                    ->showPasswordText('Show password')
                                    ->hidePasswordText('Hide password')
                                    ->copyable()
                                    ->copyIcon('heroicon-s-clipboard')
                                    ->copyTooltip('Copy password')
                                    ->copyMessage('Copied')
                                    ->password()
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Cpanel Password')),
                            ])->columns(2),
                    ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('server_name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('domain_name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('expiry_date')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
