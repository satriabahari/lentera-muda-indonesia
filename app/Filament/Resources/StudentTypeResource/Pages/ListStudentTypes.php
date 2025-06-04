<?php

namespace App\Filament\Resources\StudentTypeResource\Pages;

use App\Filament\Resources\StudentTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStudentTypes extends ListRecords
{
    protected static string $resource = StudentTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
