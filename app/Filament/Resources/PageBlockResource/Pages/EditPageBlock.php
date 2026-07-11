<?php

namespace App\Filament\Resources\PageBlockResource\Pages;

use App\Filament\Resources\PageBlockResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPageBlock extends EditRecord
{
    protected static string $resource = PageBlockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
