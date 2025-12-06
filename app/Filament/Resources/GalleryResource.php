<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Models\Gallery;
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

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-photo';

    protected static string | \UnitEnum | null $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 5;

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
                                Section::make('Gallery Information')
                                    ->columnSpanFull()
                                    ->schema([
                                        Forms\Components\Select::make('user_id')
                                            ->label('Member Angkatan (Optional)')
                                            ->relationship('user', 'name', function ($query) {
                                                $query->where('role', 'member_angkatan')->orderBy('name');
                                            })
                                            ->searchable()
                                            ->preload()
                                            ->helperText('Select a member angkatan if this gallery belongs to them')
                                            ->columnSpanFull(),
                                        
                                        Forms\Components\TextInput::make('title.id')
                                            ->label('Title (Indonesian)')
                                            ->required()
                                            ->maxLength(255),
                                        
                                        Forms\Components\TextInput::make('title.en')
                                            ->label('Title (English)')
                                            ->maxLength(255),
                                        
                                        Forms\Components\TextInput::make('title.ar')
                                            ->label('Title (Arabic)')
                                            ->maxLength(255),
                                    ])
                                    ->columns(2),
                                
                                Section::make('Description')
                                    ->columnSpanFull()
                                    ->schema([
                                        Forms\Components\Textarea::make('description')
                                            ->label('Description')
                                            ->rows(3)
                                            ->helperText('Short description about this gallery item')
                                            ->columnSpanFull(),
                                    ]),
                                
                                Section::make('Media')
                                    ->columnSpanFull()
                                    ->schema([
                                        Forms\Components\FileUpload::make('file_path')
                                            ->label('Gallery Image')
                                            ->image()
                                            ->directory('gallery')
                                            ->maxSize(5120)
                                            ->imageEditor()
                                            ->required()
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                        
                        // Right Column - Settings
                        Grid::make(2)
                            ->columnSpan(1)
                            ->schema([
                                Section::make('Settings')
                                    ->columnSpanFull()
                                    ->schema([
                                        Forms\Components\Select::make('visibility')
                                            ->label('Visibility')
                                            ->options([
                                                'public' => 'Public',
                                                'member_only' => 'Member Only',
                                            ])
                                            ->default('public')
                                            ->required(),
                                        
                                        Forms\Components\TextInput::make('batch_filter')
                                            ->label('Batch Year Filter')
                                            ->numeric()
                                            ->placeholder('e.g., 2024')
                                            ->helperText('Leave empty to show to all members'),
                                    ]),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('file_path')
                    ->label('Image')
                    ->circular(),
                
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->formatStateUsing(fn ($record) => $record->getTranslatedTitle()),
                
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Member')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                
                Tables\Columns\BadgeColumn::make('visibility')
                    ->colors([
                        'success' => 'public',
                        'warning' => 'member_only',
                    ]),
                
                Tables\Columns\TextColumn::make('batch_filter')
                    ->label('Batch')
                    ->sortable()
                    ->placeholder('-'),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('visibility')
                    ->options([
                        'public' => 'Public',
                        'member_only' => 'Member Only',
                    ]),
                
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
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
