<?php

namespace App\Filament\Resources\ThemeResource\Pages;

use App\Filament\Resources\ThemeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTheme extends CreateRecord
{
    protected static string $resource = ThemeResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // If this theme is set to active, deactivate all others
        if ($data['is_active'] ?? false) {
            \App\Models\Theme::query()->update(['is_active' => false]);
        }
        
        return $data;
    }
}
