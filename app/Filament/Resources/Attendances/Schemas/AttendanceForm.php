<?php

namespace App\Filament\Resources\Attendances\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms;
use Filament\Schemas\Components\Section;

class AttendanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Attendance Details')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('program_schedule_id')
                            ->relationship('programSchedule', 'title') // Asumsi title schedule translatable
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->title . ' (' . $record->program->name . ')')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\DateTimePicker::make('attended_at')
                            ->label('Attended At')
                            ->required(),

                        Forms\Components\Select::make('status')
                            ->options([
                                'present' => 'Present',
                                'absent' => 'Absent',
                                'late' => 'Late',
                                'excused' => 'Excused',
                            ])
                            ->default('present')
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }
}
