<?php

namespace App\Filament\Resources\AcademyRegistrations\Pages;

use App\Filament\Resources\AcademyRegistrations\AcademyRegistrationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAcademyRegistrations extends ListRecords
{
    protected static string $resource = AcademyRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
