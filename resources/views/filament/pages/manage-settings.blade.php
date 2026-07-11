<x-filament-panels::page>
    <x-filament::section>
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-lg font-medium">
                    System Settings
                </h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Manage website configuration, contact information, business hours, SEO, and feature toggles.
                </p>
            </div>
        </div>
    </x-filament::section>

    <form wire:submit="save" class="space-y-6">
        {{ $this->form }}

        <div class="flex items-center gap-4">
            <x-filament::button type="submit">
                Save Settings
            </x-filament::button>

            <x-filament::button color="gray" type="button" wire:click="$refresh">
                Refresh
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
