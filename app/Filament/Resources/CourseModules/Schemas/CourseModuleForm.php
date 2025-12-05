<?php

namespace App\Filament\Resources\CourseModules\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms;
use Filament\Schemas\Components\Section;

class CourseModuleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Module Details')
                    ->schema([
                        Forms\Components\Select::make('course_id')
                            ->relationship('course', 'title') // Asumsi title course translatable, mungkin perlu penyesuaian
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->title)
                            ->searchable()
                            ->preload()
                            ->required(),

                        // Title
                        Forms\Components\TextInput::make('title.en')->label('Title (English)')->required(),
                        Forms\Components\TextInput::make('title.id')->label('Title (Indonesian)')->required(),
                        Forms\Components\TextInput::make('title.ar')->label('Title (Arabic)'),

                        // Description
                        Forms\Components\Textarea::make('description.en')->label('Description (English)')->columnSpanFull(),
                        Forms\Components\Textarea::make('description.id')->label('Description (Indonesian)')->columnSpanFull(),
                        Forms\Components\Textarea::make('description.ar')->label('Description (Arabic)')->columnSpanFull(),

                        // Content
                        Forms\Components\RichEditor::make('content.en')->label('Content (English)')->columnSpanFull(),
                        Forms\Components\RichEditor::make('content.id')->label('Content (Indonesian)')->columnSpanFull(),
                        Forms\Components\RichEditor::make('content.ar')->label('Content (Arabic)')->columnSpanFull(),

                        Forms\Components\TextInput::make('video_url')
                            ->url()
                            ->label('Video URL')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('duration_minutes')
                            ->numeric()
                            ->label('Duration (Minutes)')
                            ->required(),

                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->default(0)
                            ->required(),

                        Forms\Components\Toggle::make('is_published')
                            ->label('Published')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
