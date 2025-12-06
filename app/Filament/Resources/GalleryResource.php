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
                                    ->schema([
                                        Forms\Components\TextInput::make('title.en')
                                            ->label('Title (English)')
                                            ->required()
                                            ->maxLength(255),
                                        
                                        Forms\Components\TextInput::make('title.id')
                                            ->label('Title (Indonesian)')
                                            ->required()
                                            ->maxLength(255),
                                        
                                        Forms\Components\TextInput::make('title.ar')
                                            ->label('Title (Arabic)')
                                            ->maxLength(255),
                                    ])
                                    ->columns(2),
                                
                                Section::make('Description')
                                    ->schema([
                                        Forms\Components\Textarea::make('description.en')
                                            ->label('Description (English)')
                                            ->rows(3),
                                        
                                        Forms\Components\Textarea::make('description.id')
                                            ->label('Description (Indonesian)')
                                            ->rows(3),
                                        
                                        Forms\Components\Textarea::make('description.ar')
                                            ->label('Description (Arabic)')
                                            ->rows(3),
                                    ]),
                                
                                Section::make('Media')
                                    ->schema([
                                        Forms\Components\Select::make('type')
                                            ->options([
                                                'image' => 'Image',
                                                'video' => 'Video',
                                            ])
                                            ->required()
                                            ->reactive()
                                            ->columnSpanFull(),
                                        
                                        Forms\Components\FileUpload::make('media_url')
                                            ->label('Media File')
                                            ->image()
                                            ->directory('gallery')
                                            ->maxSize(5120)
                                            ->imageEditor()
                                            ->visible(fn ($get) => $get('type') === 'image')
                                            ->columnSpanFull(),
                                        
                                        Forms\Components\TextInput::make('media_url')
                                            ->label('Video URL (YouTube/Vimeo)')
                                            ->url()
                                            ->placeholder('https://www.youtube.com/watch?v=...')
                                            ->visible(fn ($get) => $get('type') === 'video')
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                        
                        // Right Column - Settings
                        Grid::make(2)
                            ->columnSpan(1)
                            ->schema([
                                Section::make('Settings')
                                    ->schema([
                                        Forms\Components\DatePicker::make('event_date')
                                            ->label('Event Date'),
                                        
                                        Forms\Components\Toggle::make('is_featured')
                                            ->label('Featured')
                                            ->default(false)
                                            ->helperText('Show in featured gallery'),
                                    ]),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('media_url')
                    ->label('Media')
                    ->circular()
                    ->defaultImageUrl(fn ($record) => $record->type === 'video' ? asset('images/video-placeholder.png') : null),
                
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                
                Tables\Columns\BadgeColumn::make('type')
                    ->colors([
                        'primary' => 'image',
                        'success' => 'video',
                    ]),
                
                Tables\Columns\TextColumn::make('event_date')
                    ->date()
                    ->sortable(),
                
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'image' => 'Image',
                        'video' => 'Video',
                    ]),
                
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Featured'),
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
            ->defaultSort('event_date', 'desc');
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
