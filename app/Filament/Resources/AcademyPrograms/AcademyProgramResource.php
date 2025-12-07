<?php

namespace App\Filament\Resources\AcademyPrograms;

use App\Filament\Resources\AcademyPrograms\Pages\CreateAcademyProgram;
use App\Filament\Resources\AcademyPrograms\Pages\EditAcademyProgram;
use App\Filament\Resources\AcademyPrograms\Pages\ListAcademyPrograms;
use App\Filament\Resources\AcademyPrograms\Schemas\AcademyProgramForm;
use App\Filament\Resources\AcademyPrograms\Tables\AcademyProgramsTable;
use App\Models\AcademyProgram;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AcademyProgramResource extends Resource
{
    protected static ?string $model = AcademyProgram::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    
    protected static string|\UnitEnum|null $navigationGroup = 'Manaahel Academy';
    
    protected static ?string $navigationLabel = 'Programs';

    public static function form(Schema $schema): Schema
    {
        return AcademyProgramForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AcademyProgramsTable::configure($table);
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
            'index' => ListAcademyPrograms::route('/'),
            'create' => CreateAcademyProgram::route('/create'),
            'edit' => EditAcademyProgram::route('/{record}/edit'),
        ];
    }
}
