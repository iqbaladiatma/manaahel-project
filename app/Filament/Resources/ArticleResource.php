<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Filament\Schemas\Components\Section;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-newspaper';

    protected static string | \UnitEnum | null $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 2;

    // --- FORM (CREATE/EDIT) ---
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Article Details')
                    ->schema([
                        // --- Title Fields (Indonesian WAJIB, English Optional) ---
                        Forms\Components\TextInput::make('title.id')
                            ->label('Title (Indonesian)')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (callable $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('title.en')
                            ->label('Title (English)')
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('title.ar')
                            ->label('Title (Arabic)')
                            ->maxLength(255),
                        
                        // --- Slug (Auto-generated, tidak bisa di-custom) ---
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated()
                            ->helperText('Auto-generated from Indonesian title'),
                        
                        // --- Category ---
                        Forms\Components\Select::make('category_id')
                            ->label('Category')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name.id')
                                    ->label('Name (Indonesian)')
                                    ->required(),
                                Forms\Components\TextInput::make('name.en')
                                    ->label('Name (English)'),
                            ])
                            ->required(),
                        
                        Forms\Components\FileUpload::make('image_url')
                            ->label('Featured Image')
                            ->image()
                            ->directory('articles')
                            ->maxSize(2048)
                            ->columnSpanFull(), // Pastikan image menggunakan kolom penuh
                        
                        // --- Content Fields (Indonesian WAJIB, English Optional) ---
                        Forms\Components\RichEditor::make('content.id')
                            ->label('Content (Indonesian)')
                            ->required()
                            ->columnSpanFull(),
                        
                        Forms\Components\RichEditor::make('content.en')
                            ->label('Content (English)')
                            ->columnSpanFull(),
                        
                        Forms\Components\RichEditor::make('content.ar')
                            ->label('Content (Arabic)')
                            ->columnSpanFull(),
                        
                        Forms\Components\Toggle::make('is_published')
                            ->label('Published')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }

    // --- TABLE (LIST) ---
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Image')
                    ->circular(),
                
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                
                Tables\Columns\TextColumn::make('category.name')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name'),
                
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
            ]);
    }

    // --- RELATIONS, PAGES, QUERY ---

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder // Ganti type-hint menjadi Builder
    {
        return parent::getEloquentQuery()
            ->with(['category']);
    }
}