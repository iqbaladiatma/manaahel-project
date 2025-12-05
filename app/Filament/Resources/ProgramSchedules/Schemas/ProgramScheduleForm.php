<?php

namespace App\Filament\Resources\ProgramSchedules\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms;
use Filament\Schemas\Components\Section;

class ProgramScheduleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Schedule Details')
                    ->schema([
                        Forms\Components\Select::make('program_id')
                            ->relationship('program', 'name') // Asumsi name program translatable
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->name)
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

                        Forms\Components\TextInput::make('meeting_link')
                            ->url()
                            ->label('Meeting Link')
                            ->columnSpanFull(),

                        Forms\Components\DateTimePicker::make('scheduled_at')
                            ->label('Scheduled At')
                            ->required(),

                        Forms\Components\TextInput::make('duration_minutes')
                            ->numeric()
                            ->label('Duration (Minutes)')
                            ->required(),

                        Forms\Components\Toggle::make('attendance_enabled')
                            ->label('Enable Attendance')
                            ->default(false),
                    ])
                    ->columns(2),
            ]);
    }
}
