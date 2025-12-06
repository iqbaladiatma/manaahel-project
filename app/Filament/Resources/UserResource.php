<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-users';

    protected static string | \UnitEnum | null $navigationGroup = 'User Management';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Grid::make(2)
                    ->schema([
                        // Left Column - Main Info
                        Grid::make(2)
                            ->columnSpan(2)
                            ->schema([
                                Section::make('Account Information')
                                    ->columnSpanFull()
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->maxLength(255),
                                        
                                        Forms\Components\TextInput::make('email')
                                            ->email()
                                            ->required()
                                            ->unique(ignoreRecord: true)
                                            ->maxLength(255),
                                        
                                        Forms\Components\TextInput::make('password')
                                            ->password()
                                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                                            ->dehydrated(fn ($state) => filled($state))
                                            ->required(fn (string $context): bool => $context === 'create')
                                            ->maxLength(255),
                                        
                                        Forms\Components\Select::make('role')
                                            ->options([
                                                'admin' => 'Admin',
                                                'member_angkatan' => 'Member Angkatan',
                                                'member_program' => 'Member Program',
                                                'member' => 'Member',
                                                'user' => 'User',
                                            ])
                                            ->required()
                                            ->default('user'),
                                    ])
                                    ->columns(2),
                                
                                Section::make('Personal Information')
                                    ->columnSpanFull()
                                    ->schema([
                                        Forms\Components\TextInput::make('phone')
                                            ->tel()
                                            ->maxLength(20),
                                        
                                        Forms\Components\DatePicker::make('date_of_birth')
                                            ->label('Date of Birth'),
                                        
                                        Forms\Components\Select::make('gender')
                                            ->options([
                                                'male' => 'Male',
                                                'female' => 'Female',
                                            ]),
                                        
                                        Forms\Components\TextInput::make('batch_year')
                                            ->label('Angkatan/Batch Year')
                                            ->maxLength(10),
                                        
                                        Forms\Components\TextInput::make('city')
                                            ->maxLength(100),
                                        
                                        Forms\Components\Textarea::make('bio')
                                            ->label('Biography')
                                            ->rows(3)
                                            ->maxLength(500)
                                            ->helperText('Short bio about yourself')
                                            ->columnSpanFull(),
                                        
                                        Forms\Components\Textarea::make('address')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),
                                
                                Section::make('Social Media')
                                    ->columnSpanFull()
                                    ->schema([
                                        Forms\Components\TextInput::make('instagram_url')
                                            ->label('Instagram')
                                            ->url()
                                            ->maxLength(255)
                                            ->prefix('https://'),
                                        
                                        Forms\Components\TextInput::make('facebook_url')
                                            ->label('Facebook')
                                            ->url()
                                            ->maxLength(255)
                                            ->prefix('https://'),
                                        
                                        Forms\Components\TextInput::make('twitter_url')
                                            ->label('Twitter/X')
                                            ->url()
                                            ->maxLength(255)
                                            ->prefix('https://'),
                                        
                                        Forms\Components\TextInput::make('linkedin_url')
                                            ->label('LinkedIn')
                                            ->url()
                                            ->maxLength(255)
                                            ->prefix('https://'),
                                        
                                        Forms\Components\TextInput::make('youtube_url')
                                            ->label('YouTube')
                                            ->url()
                                            ->maxLength(255)
                                            ->prefix('https://'),
                                        
                                        Forms\Components\TextInput::make('tiktok_url')
                                            ->label('TikTok')
                                            ->url()
                                            ->maxLength(255)
                                            ->prefix('https://'),
                                    ])
                                    ->columns(2)
                                    ->collapsible(),
                            ]),
                        
                        // Right Column - Avatar & Location
                        Grid::make(2)
                            ->columnSpan(1)
                            ->schema([
                                Section::make('Avatar')
                                    ->columnSpanFull()
                                    ->schema([
                                        Forms\Components\FileUpload::make('avatar_url')
                                            ->label('Profile Picture')
                                            ->image()
                                            ->directory('avatars')
                                            ->maxSize(1024)
                                            ->imageEditor()
                                            ->circleCropper(),
                                    ]),
                                
                                Section::make('Location')
                                    ->columnSpanFull()
                                    ->schema([
                                        Forms\Components\TextInput::make('latitude')
                                            ->numeric()
                                            ->step(0.00000001)
                                            ->helperText('GPS Latitude'),
                                        
                                        Forms\Components\TextInput::make('longitude')
                                            ->numeric()
                                            ->step(0.00000001)
                                            ->helperText('GPS Longitude'),
                                    ])
                                    ->collapsible(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar_url')
                    ->label('Avatar')
                    ->circular(),
                
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\BadgeColumn::make('role')
                    ->colors([
                        'danger' => 'admin',
                        'success' => 'member_angkatan',
                        'primary' => 'member_program',
                        'warning' => 'member',
                        'secondary' => 'user',
                    ]),
                
                Tables\Columns\TextColumn::make('batch_year')
                    ->label('Angkatan')
                    ->sortable()
                    ->toggleable(),
                
                Tables\Columns\TextColumn::make('registrations_count')
                    ->counts('registrations')
                    ->label('Registrations')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'member_angkatan' => 'Member Angkatan',
                        'member_program' => 'Member Program',
                        'member' => 'Member',
                        'user' => 'User',
                    ]),
                
                Tables\Filters\TernaryFilter::make('email_verified_at')
                    ->label('Email Verified')
                    ->nullable(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
