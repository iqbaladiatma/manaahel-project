<?php

namespace App\Filament\Resources\CourseResource\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Course Information')
                    ->schema([
                        Tabs::make('Translations')
                            ->tabs([
                                Tabs\Tab::make('Indonesian')
                                    ->schema([
                                        TextInput::make('title.id')
                                            ->label('Title (Indonesian)')
                                            ->required()
                                            ->maxLength(255),
                                        
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
                        
                        Select::make('program_id')
                            ->label('Program (Optional)')
                            ->relationship('program', 'name')
                            ->searchable()
                            ->preload()
                            ->getOptionLabelFromRecordUsing(fn ($record) => is_array($record->name) ? ($record->name['en'] ?? $record->name['id'] ?? '') : $record->name)
                            ->helperText('Leave empty to make course available to all members'),
                        
                        TextInput::make('video_url')
                            ->label('Video URL')
                            ->url()
                            ->maxLength(500)
                            ->helperText('YouTube URL or direct video link')
                            ->placeholder('https://www.youtube.com/watch?v=...'),
                    ])
                    ->columns(2),
            ]);
    }
}
