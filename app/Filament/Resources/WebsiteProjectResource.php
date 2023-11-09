<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WebsiteProjectResource\Pages;
use App\Filament\Resources\WebsiteProjectResource\RelationManagers;
use App\Models\WebsiteProject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;
use Rawilk\FilamentPasswordInput\Password;

class WebsiteProjectResource extends Resource
{
    protected static ?string $model = WebsiteProject::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Project Details')
                            ->schema([
                                Forms\Components\Select::make('client_id')
                                    ->searchable()
                                    ->relationship(name: 'Client', titleAttribute: 'name')
                                    ->options(function () {
                                        return \App\Models\Client::all()->pluck('name', 'id');
                                    })
                                    ->createOptionForm([
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
                                    ])->columnSpan('full'),
                                //Project Name will use client domain.
                                Forms\Components\Select::make('domain_name_id')
                                    ->label('Domain Name')
                                    ->searchable()
                                    ->relationship(name: 'Domain', titleAttribute: 'domain_name')
                                    ->options(function () {
                                        return \App\Models\Domain::all()->pluck('domain_name', 'id');
                                    })
                                    // Start Create a new domain for project
                                    ->createOptionForm([
                                        Forms\Components\Group::make()
                                            ->schema([
                                                Forms\Components\Section::make('Domain Details')
                                                    ->schema([
                                                        Forms\Components\TextInput::make('domain_name')
                                                            ->autofocus()
                                                            ->required()
                                                            ->placeholder(__('Domain Name'))
                                                            ->columnSpan('full'),

                                                    ])->columns(2),

                                                Forms\Components\Section::make('Other Details')
                                                    ->schema([
                                                        Forms\Components\Select::make('client_id')
                                                            ->relationship('client', 'name')
                                                            ->required()
                                                            ->searchable()
                                                            ->options(function () {
                                                                return \App\Models\Client::all()->pluck('name', 'id');
                                                            }),
                                                        Forms\Components\Select::make('staff_id')
                                                            ->relationship('staff', 'name')
                                                            ->required()
                                                            ->searchable()
                                                            ->options(function () {
                                                                return \App\Models\Staff::all()->pluck('name', 'id');
                                                            })

                                                    ])->columns(2),
                                            ]),
                                        Forms\Components\Group::make()
                                            ->schema([
                                                Forms\Components\Section::make('Domain Status')
                                                    ->schema([
                                                        Forms\Components\Toggle::make('is_active')
                                                            ->autofocus()
                                                            ->required(),

                                                    ])->columns(2),

                                            ]),
                                        // End Create a new domain for project
                                    ])->columnSpan('full')
                                    ->editOptionForm([
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
                                                        Forms\Components\Select::make('client_id')
                                                            ->hint(new HtmlString('<a href="/clients/create">Add New Client</a>'))
                                                            ->hintColor('primary')
                                                            ->hintIcon('heroicon-o-plus-circle', tooltip: 'Add New Client')
                                                            ->relationship('client', 'name')
                                                            ->required()
                                                            ->searchable()
                                                            ->options(function () {
                                                                return \App\Models\Client::all()->pluck('name', 'id');
                                                            }),
                                                        Forms\Components\Select::make('staff_id')
                                                            ->relationship('staff', 'name')
                                                            ->required()
                                                            ->searchable()
                                                            ->options(function () {
                                                                return \App\Models\Staff::all()->pluck('name', 'id');
                                                            })

                                                    ])->columns(2),
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
                                                        Forms\Components\Select::make('domain_registrar_id')
                                                            ->searchable()
                                                            ->relationship(name: 'DomainRegistrar', titleAttribute: 'registrar_name')
                                                            ->options(function () {
                                                                return \App\Models\DomainRegistrar::all()->pluck('registrar_name', 'id');
                                                            })
                                                            ->createOptionForm([
                                                                Forms\Components\TextInput::make('registrar_name')
                                                                    ->required(),
                                                                Forms\Components\TextInput::make('website')
                                                                    ->required(),
                                                            ])->columnSpan('full'),
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
                                    ]),
                                Forms\Components\DatePicker::make('date')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Date')),
                                Forms\Components\Select::make('salesperson_id')
                                    ->relationship('salesperson')
                                    ->searchable()
                                    ->label('Sales Person')
                                    ->options(function () {
                                        return \App\Models\Staff::all()->pluck('name', 'id');
                                    }),
                                Forms\Components\Select::make('person_in_charge_id')
                                    ->relationship('personInCharge')
                                    ->searchable()
                                    ->label('Person In Charge')
                                    ->options(function () {
                                        return \App\Models\Staff::all()->pluck('name', 'id');
                                    }),
                                Forms\Components\Select::make('coordinator_id')
                                    ->relationship('coordinator')
                                    ->searchable()
                                    ->label('Project Coordinator')
                                    ->options(function () {
                                        return \App\Models\Staff::all()->pluck('name', 'id');
                                    }),

                            ])->columns(2),
                    ]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Status & Details')
                            ->schema([
                                Forms\Components\Select::make('project_status')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Project Status'))
                                    ->options([
                                        'Domain Pending' => 'Domain Pending',
                                        'Domain Locked' => 'Domain Locked',
                                        'Domain Purchased' => 'Domain Purchased',
                                        'Work In Progress' => 'Work In Progress',
                                        'Done' => 'Done',
                                        'Cancel' => 'Cancel',
                                    ]),
                                Forms\Components\RichEditor::make('project_description')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Project Description')),

                            ]),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('domain.domain_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('client.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('salesperson.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('personInCharge.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('coordinator.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\SelectColumn::make('project_status')
                    ->sortable()
                    ->searchable()
                    ->options([
                        'Domain Pending' => 'Domain Pending',
                        'Domain Locked' => 'Domain Locked',
                        'Domain Purchased' => 'Domain Purchased',
                        'Work In Progress' => 'Work In Progress',
                        'Done' => 'Done',
                        'Cancel' => 'Cancel',
                    ]),

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
            'index' => Pages\ListWebsiteProjects::route('/'),
            'create' => Pages\CreateWebsiteProject::route('/create'),
         //   'edit' => Pages\EditWebsiteProject::route('/{record}/edit'),
        ];
    }
}
