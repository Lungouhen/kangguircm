@props(['items', 'showDropdowns' => true])

@if($items->isEmpty())
    {{-- Fallback to static navigation if no dynamic menu items --}}
    <div class="hidden md:flex items-center space-x-8">
        <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 transition {{ request()->routeIs('home') ? 'text-blue-600 font-semibold' : '' }}">Home</a>
        <a href="{{ route('about') }}" class="text-gray-700 hover:text-blue-600 transition {{ request()->routeIs('about') ? 'text-blue-600 font-semibold' : '' }}">About</a>
        <a href="{{ route('services.index') }}" class="text-gray-700 hover:text-blue-600 transition {{ request()->routeIs('services.*') ? 'text-blue-600 font-semibold' : '' }}">Services</a>
        <a href="{{ route('blog') }}" class="text-gray-700 hover:text-blue-600 transition {{ request()->routeIs('blog') ? 'text-blue-600 font-semibold' : '' }}">Blog</a>
        <a href="{{ route('careers') }}" class="text-gray-700 hover:text-blue-600 transition {{ request()->routeIs('careers') ? 'text-blue-600 font-semibold' : '' }}">Careers</a>
        <a href="{{ route('contact') }}" class="text-gray-700 hover:text-blue-600 transition {{ request()->routeIs('contact') ? 'text-blue-600 font-semibold' : '' }}">Contact</a>
    </div>
@else
    <nav class="hidden md:flex items-center space-x-8" x-data="{ openDropdown: null }">
        @foreach($items as $item)
            @if($showDropdowns && $item->children->count() > 0)
                <div class="relative" 
                     @mouseenter="openDropdown = '{{ $item->id }}'" 
                     @mouseleave="openDropdown = null">
                    <button class="flex items-center space-x-1 {{ $item->isActiveRoute() ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600' }} transition">
                        <span>{{ $item->title }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    <div x-show="openDropdown === '{{ $item->id }}'" 
                         @click.away="openDropdown = null"
                         class="absolute top-full left-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 py-2 z-50"
                         style="display: none;">
                        @foreach($item->activeChildren() as $child)
                            <a href="{{ $child->url }}" 
                               target="{{ $child->target }}"
                               class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-blue-600 transition {{ $child->isActiveRoute() ? 'bg-gray-50 text-blue-600' : '' }}">
                                @if($child->icon)
                                    <span class="mr-2">{!! $child->icon !!}</span>
                                @endif
                                {{ $child->title }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                <a href="{{ $item->url }}" 
                   target="{{ $item->target }}"
                   class="{{ $item->isActiveRoute() ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600' }} transition">
                    @if($item->icon)
                        <span class="mr-1">{!! $item->icon !!}</span>
                    @endif
                    {{ $item->title }}
                </a>
            @endif
        @endforeach
    </nav>
@endif

{{-- Mobile menu with dynamic items --}}
<div id="mobile-menu-dynamic" class="hidden md:hidden bg-white border-t border-gray-100" x-data="{ openSubmenu: null }">
    <div class="px-4 py-3 space-y-3">
        @forelse($items as $item)
            @if($showDropdowns && $item->children->count() > 0)
                <div>
                    <button @click="openSubmenu = openSubmenu === '{{ $item->id }}' ? null : '{{ $item->id }}'"
                            class="flex justify-between items-center w-full text-left text-gray-700 hover:text-blue-600 {{ $item->isActiveRoute() ? 'font-semibold text-blue-600' : '' }}">
                        <span>{{ $item->title }}</span>
                        <svg class="w-4 h-4 transition-transform" :class="openSubmenu === '{{ $item->id }}' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="openSubmenu === '{{ $item->id }}'" class="mt-2 ml-4 space-y-2">
                        @foreach($item->activeChildren() as $child)
                            <a href="{{ $child->url }}" 
                               target="{{ $child->target }}"
                               class="block text-gray-600 hover:text-blue-600 {{ $child->isActiveRoute() ? 'text-blue-600 font-semibold' : '' }}">
                                {{ $child->title }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                <a href="{{ $item->url }}" 
                   target="{{ $item->target }}"
                   class="block text-gray-700 hover:text-blue-600 {{ $item->isActiveRoute() ? 'text-blue-600 font-semibold' : '' }}">
                    {{ $item->title }}
                </a>
            @endif
        @empty
            <a href="{{ route('home') }}" class="block text-gray-700 hover:text-blue-600">Home</a>
            <a href="{{ route('about') }}" class="block text-gray-700 hover:text-blue-600">About</a>
            <a href="{{ route('services.index') }}" class="block text-gray-700 hover:text-blue-600">Services</a>
            <a href="{{ route('blog') }}" class="block text-gray-700 hover:text-blue-600">Blog</a>
            <a href="{{ route('careers') }}" class="block text-gray-700 hover:text-blue-600">Careers</a>
            <a href="{{ route('contact') }}" class="block text-gray-700 hover:text-blue-600">Contact</a>
        @endforelse
    </div>
</div>
