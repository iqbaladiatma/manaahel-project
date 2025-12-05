<?php

namespace App\Filament\Resources\ProgramSchedules\Pages;

use App\Filament\Resources\ProgramSchedules\ProgramScheduleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProgramSchedules extends ListRecords
{
    protected static string $resource = ProgramScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
