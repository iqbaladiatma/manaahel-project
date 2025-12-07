<?php

namespace App\Filament\Resources\AcademyPrograms\Pages;

use App\Filament\Resources\AcademyPrograms\AcademyProgramResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAcademyProgram extends EditRecord
{
    protected static string $resource = AcademyProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
