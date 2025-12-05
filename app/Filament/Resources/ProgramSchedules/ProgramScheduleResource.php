<?php

namespace App\Filament\Resources\ProgramSchedules;

use App\Filament\Resources\ProgramSchedules\Pages\CreateProgramSchedule;
use App\Filament\Resources\ProgramSchedules\Pages\EditProgramSchedule;
use App\Filament\Resources\ProgramSchedules\Pages\ListProgramSchedules;
use App\Filament\Resources\ProgramSchedules\Schemas\ProgramScheduleForm;
use App\Filament\Resources\ProgramSchedules\Tables\ProgramSchedulesTable;
use App\Models\ProgramSchedule;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProgramScheduleResource extends Resource
{
    protected static ?string $model = ProgramSchedule::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    
    protected static ?string $navigationLabel = 'Program Schedules';
    
    protected static string | \UnitEnum | null $navigationGroup = 'Learning Management';
    
    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return ProgramScheduleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProgramSchedulesTable::configure($table);
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
            'index' => ListProgramSchedules::route('/'),
            'create' => CreateProgramSchedule::route('/create'),
            'edit' => EditProgramSchedule::route('/{record}/edit'),
        ];
    }
}
