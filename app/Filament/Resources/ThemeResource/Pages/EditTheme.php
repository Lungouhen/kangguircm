<?php

namespace App\Filament\Resources\ThemeResource\Pages;

use App\Filament\Resources\ThemeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTheme extends EditRecord
{
    protected static string $resource = ThemeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // If this theme is set to active, deactivate all others
        if ($data['is_active'] ?? false) {
            \App\Models\Theme::query()
                ->where('id', '!=', $this->record->id)
                ->update(['is_active' => false]);
        }
        
        return $data;
    }
}
