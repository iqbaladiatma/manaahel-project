<?php

namespace App\Filament\Resources\ProgramSchedules\Pages;

use App\Filament\Resources\ProgramSchedules\ProgramScheduleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProgramSchedule extends EditRecord
{
    protected static string $resource = ProgramScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
