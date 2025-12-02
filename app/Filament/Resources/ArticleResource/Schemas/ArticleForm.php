<?php

namespace App\Filament\Resources\ArticleResource\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Article Information')
                    ->schema([
                        Tabs::make('Translations')
                            ->tabs([
                                Tabs\Tab::make('Indonesian')
                                    ->schema([
                                        TextInput::make('title.id')
                                            ->label('Title (Indonesian)')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function ($state, callable $set, $get) {
                                                if (empty($get('slug'))) {
                                                    $set('slug', Str::slug($state));
                                                }
                                            }),
                                        
                                        RichEditor::make('content.id')
                                            ->label('Content (Indonesian)')
                                            ->required()
                                            ->columnSpanFull(),
                                    ]),
                                
                                Tabs\Tab::make('English')
                                    ->schema([
                                        TextInput::make('title.en')
                                            ->label('Title (English)')
                                            ->required()
                                            ->maxLength(255),
                                        
                                        RichEditor::make('content.en')
                                            ->label('Content (English)')
                                            ->required()
                                            ->columnSpanFull(),
                                    ]),
                                
                                Tabs\Tab::make('Arabic')
                                    ->schema([
                                        TextInput::make('title.ar')
                                            ->label('Title (Arabic)')
                                            ->required()
                                            ->maxLength(255),
                                        
                                        RichEditor::make('content.ar')
                                            ->label('Content (Arabic)')
                                            ->required()
                                            ->columnSpanFull(),
                                    ]),
                            ])
                            ->columnSpanFull(),
                        
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('URL-friendly version of the title'),
                        
                        Select::make('category_id')
                            ->label('Category')
                            ->relationship('category', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->getOptionLabelFromRecordUsing(fn ($record) => is_array($record->name) ? ($record->name['en'] ?? $record->name['id'] ?? '') : $record->name),
                        
                        Toggle::make('is_featured')
                            ->label('Featured Article')
                            ->default(false)
                            ->helperText('Featured articles appear on the homepage'),
                    ])
                    ->columns(2),
            ]);
    }
}
