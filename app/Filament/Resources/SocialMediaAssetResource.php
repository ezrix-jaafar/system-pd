<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialMediaAssetResource\Pages;
use App\Filament\Resources\SocialMediaAssetResource\RelationManagers;
use App\Models\SocialMediaAsset;
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
use Rawilk\FilamentPasswordInput\Password;

class SocialMediaAssetResource extends Resource
{
    protected static ?string $model = SocialMediaAsset::class;

    protected static ?string $navigationGroup = 'Assets Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Account Details')
                            ->schema([
                                Forms\Components\TextInput::make('account_name')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Account Name'))
                                    ->columnSpan('full'),
                                Forms\Components\TextInput::make('account_url')
                                    ->prefixIcon('heroicon-m-globe-alt')
                                    ->url()
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Account URL'))
                                    ->columnSpan('full'),
                                Forms\Components\Select::make('platform')
                                    ->options([
                                        'Facebook' => 'Facebook',
                                        'Instagram' => 'Instagram',
                                        'LinkedIn' => 'LinkedIn',
                                        'TikTok' => 'TikTok',
                                        'Shopee' => 'Shopee',
                                    ])
                                    ->required(),
                                Forms\Components\Select::make('account_type')
                                    ->options([
                                        'Personal' => 'Personal',
                                        'Business' => 'Business',
                                        'Group' => 'Group',
                                        'Page' => 'Page',
                                    ])
                                    ->required(),
                                Forms\Components\TagsInput::make('account_niche')
                                    ->splitKeys(['Tab', 'Enter', ','])
                                    ->hint('Press Tab, Enter or Comma to add a tag')
                                    ->columnSpan('full'),
                                Forms\Components\Textarea::make('account_note')
                                    ->autofocus()
                                    ->rows(5)
                                    ->placeholder(__('Account Note'))
                                    ->columnSpan('full'),
                            ])->columns(2),
                    ]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Login Details')
                            ->schema([
                                Forms\Components\TextInput::make('account_username')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Login Username')),
                                Password::make('account_password')
                                    ->showPasswordText('Show password')
                                    ->hidePasswordText('Hide password')
                                    ->copyable()
                                    ->copyIcon('heroicon-s-clipboard')
                                    ->copyTooltip('Copy password')
                                    ->copyMessage('Copied')
                                    ->password()
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Login Password')),
                                Forms\Components\TextInput::make('account_email')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Login Email'))
                                    ->columnSpan('full'),
                                Forms\Components\TextInput::make('account_phone')
                                    ->tel()
                                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                                    ->autofocus()
                                    ->required()
                                    ->placeholder(__('Login Phone'))
                                    ->columnSpan('full'),
                            ])->columns(2),
                        Forms\Components\Section::make('Secret Question')
                            ->schema([
                                Forms\Components\Repeater::make('secret_question')
                                    ->hiddenLabel()
                                    ->schema([
                                        Forms\Components\TextInput::make('question')
                                            ->autofocus()
                                            ->placeholder(__('Question')),
                                        Forms\Components\TextInput::make('answer')
                                            ->autofocus()
                                            ->placeholder(__('Answer')),
                                    ]),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('account_name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('account_url')
                    ->searchable()
                    ->icon('heroicon-o-link')
                    ->url(function ($record) {
                        return url($record->account_url);
                    }),
                TextColumn::make('platform')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Facebook' => 'info',
                        'Instagram' => 'danger',
                        'LinkedIn' => 'success',
                        'TikTok' => 'gray',
                        'Shopee' => 'warning',
                    }),
                TextColumn::make('account_type')
                    ->searchable()
                    ->sortable()->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Personal' => 'danger',
                        'Business' => 'success',
                        'Group' => 'info',
                        'Page' => 'warning',
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

            RelationManagers\AssetHolderRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSocialMediaAssets::route('/'),
            'create' => Pages\CreateSocialMediaAsset::route('/create'),
            'edit' => Pages\EditSocialMediaAsset::route('/{record}/edit'),
        ];
    }
}
