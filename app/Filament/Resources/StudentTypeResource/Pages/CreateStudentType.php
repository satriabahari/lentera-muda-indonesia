<?php

namespace App\Filament\Resources\StudentTypeResource\Pages;

use App\Filament\Resources\StudentTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStudentType extends CreateRecord
{
    protected static string $resource = StudentTypeResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
