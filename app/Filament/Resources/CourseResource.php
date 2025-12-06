<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Models\Course;
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

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-book-open';

    protected static string | \UnitEnum | null $navigationGroup = 'Learning Management';

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
                                Section::make('Course Information')
                                    ->schema([
                                        Forms\Components\Select::make('program_id')
                                            ->label('Program')
                                            ->relationship('program', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->required()
                                            ->columnSpanFull(),
                                        
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
                                            ->required()
                                            ->rows(3),
                                        
                                        Forms\Components\Textarea::make('description.id')
                                            ->label('Description (Indonesian)')
                                            ->required()
                                            ->rows(3),
                                        
                                        Forms\Components\Textarea::make('description.ar')
                                            ->label('Description (Arabic)')
                                            ->rows(3),
                                    ]),
                                
                                Section::make('Content')
                                    ->schema([
                                        Forms\Components\RichEditor::make('content.en')
                                            ->label('Content (English)')
                                            ->required()
                                            ->columnSpanFull(),
                                        
                                        Forms\Components\RichEditor::make('content.id')
                                            ->label('Content (Indonesian)')
                                            ->required()
                                            ->columnSpanFull(),
                                        
                                        Forms\Components\RichEditor::make('content.ar')
                                            ->label('Content (Arabic)')
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                        
                        // Right Column - Settings
                        Grid::make(2)
                            ->columnSpan(1)
                            ->schema([
                                Section::make('Settings')
                                    ->schema([
                                        Forms\Components\TextInput::make('order')
                                            ->label('Display Order')
                                            ->numeric()
                                            ->default(0)
                                            ->required()
                                            ->helperText('Order in program'),
                                        
                                        Forms\Components\Toggle::make('is_published')
                                            ->label('Published')
                                            ->default(true)
                                            ->helperText('Make course visible'),
                                    ]),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('program.name')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
                
                Tables\Columns\IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('program')
                    ->relationship('program', 'name'),
                
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Published'),
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
            ->defaultSort('order');
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
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->with(['program']);
    }
}
