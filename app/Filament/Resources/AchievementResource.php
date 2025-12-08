<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AchievementResource\Pages;
use App\Models\Achievement;
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

class AchievementResource extends Resource
{
    protected static ?string $model = Achievement::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-trophy';

    protected static string | \UnitEnum | null $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 6;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Grid::make(2)
                    ->schema([
                        // Left Column
                        Grid::make(2)
                            ->columnSpan(2)
                            ->schema([
                                Section::make('Achievement Information')
                                    ->columnSpanFull()
                                    ->schema([
                                        Forms\Components\Select::make('user_id')
                                            ->label('Member')
                                            ->relationship('user', 'name', function ($query) {
                                                $query->where('role', 'member_angkatan')->orderBy('name');
                                            })
                                            ->searchable()
                                            ->preload()
                                            ->required()
                                            ->columnSpanFull(),
                                        
                                        Forms\Components\TextInput::make('title')
                                            ->label('Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->columnSpanFull(),
                                        
                                        Forms\Components\Textarea::make('description')
                                            ->label('Description')
                                            ->rows(4)
                                            ->maxLength(1000)
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(1),
                            ]),
                        
                        // Right Column
                        Grid::make(2)
                            ->columnSpan(1)
                            ->schema([
                                Section::make('Details')
                                    ->columnSpanFull()
                                    ->schema([
                                        Forms\Components\TextInput::make('icon')
                                            ->label('Icon (Emoji or Icon Name)')
                                            ->placeholder('🏆')
                                            ->helperText('Use emoji or heroicon name'),
                                        
                                        Forms\Components\DatePicker::make('achieved_at')
                                            ->label('Achievement Date')
                                            ->default(now()),
                                        
                                        Forms\Components\FileUpload::make('certificate_url')
                                            ->label('Certificate')
                                            ->image()
                                            ->directory('certificates')
                                            ->maxSize(2048),
                                        
                                        Forms\Components\TextInput::make('order')
                                            ->label('Display Order')
                                            ->numeric()
                                            ->default(0)
                                            ->helperText('Lower numbers appear first'),
                                    ]),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Member')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->wrap(),
                
                Tables\Columns\TextColumn::make('icon')
                    ->label('Icon')
                    ->alignCenter(),
                
                Tables\Columns\TextColumn::make('achieved_at')
                    ->label('Date')
                    ->date()
                    ->sortable(),
                
                Tables\Columns\ImageColumn::make('certificate_url')
                    ->label('Certificate')
                    ->circular(),
                
                Tables\Columns\TextColumn::make('order')
                    ->sortable()
                    ->alignCenter(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order', 'asc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAchievements::route('/'),
            'create' => Pages\CreateAchievement::route('/create'),
            'edit' => Pages\EditAchievement::route('/{record}/edit'),
        ];
    }
}
