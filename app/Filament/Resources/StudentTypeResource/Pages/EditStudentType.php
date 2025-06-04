<?php

namespace App\Filament\Resources\StudentTypeResource\Pages;

use App\Filament\Resources\StudentTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStudentType extends EditRecord
{
    protected static string $resource = StudentTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
