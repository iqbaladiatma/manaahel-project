<?php

namespace App\Filament\Resources\AcademyRegistrations\Pages;

use App\Filament\Resources\AcademyRegistrations\AcademyRegistrationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAcademyRegistration extends EditRecord
{
    protected static string $resource = AcademyRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
