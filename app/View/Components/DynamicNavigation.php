<?php

namespace App\View\Components;

use App\Models\Menu;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DynamicNavigation extends Component
{
    public function __construct(
        public string $location = 'header',
        public ?string $menuName = null,
        public bool $showDropdowns = true,
        public string $activeClass = 'text-blue-600 font-semibold',
        public string $inactiveClass = 'text-gray-700 hover:text-blue-600 transition'
    ) {}

    public function render(): View|Closure|string
    {
        $menu = $this->menuName 
            ? Menu::where('name', $this->menuName)->where('is_active', true)->first()
            : Menu::getByLocation($this->location);

        $items = $menu?->activeItems()->with('children')->get() ?? collect();

        return view('components.dynamic-navigation', [
            'items' => $items,
            'showDropdowns' => $this->showDropdowns,
        ]);
    }
}
