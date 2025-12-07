<?php

namespace App\Filament\Resources\AcademyRegistrations;

use App\Filament\Resources\AcademyRegistrations\Pages\CreateAcademyRegistration;
use App\Filament\Resources\AcademyRegistrations\Pages\EditAcademyRegistration;
use App\Filament\Resources\AcademyRegistrations\Pages\ListAcademyRegistrations;
use App\Filament\Resources\AcademyRegistrations\Schemas\AcademyRegistrationForm;
use App\Filament\Resources\AcademyRegistrations\Tables\AcademyRegistrationsTable;
use App\Models\AcademyRegistration;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AcademyRegistrationResource extends Resource
{
    protected static ?string $model = AcademyRegistration::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;
    
    protected static string|\UnitEnum|null $navigationGroup = 'Manaahel Academy';
    
    protected static ?string $navigationLabel = 'Registrations';

    public static function form(Schema $schema): Schema
    {
        return AcademyRegistrationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AcademyRegistrationsTable::configure($table);
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
            'index' => ListAcademyRegistrations::route('/'),
            'create' => CreateAcademyRegistration::route('/create'),
            'edit' => EditAcademyRegistration::route('/{record}/edit'),
        ];
    }
}
