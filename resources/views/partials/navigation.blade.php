<nav class="bg-white shadow-md border-b border-gray-200" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    @php
                        $theme = \App\Models\Theme::active();
                        $logo = $theme?->logo ?? config('settings.website.logo');
                    @endphp
                    @if($logo)
                        <img src="{{ asset('storage/' . $logo) }}" alt="{{ config('app.name') }}" class="h-10 w-auto">
                    @else
                        <span class="text-2xl font-bold" style="color: var(--color-primary); font-family: var(--font-heading);">Kanggui RCM</span>
                    @endif
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-1">
                @php
                    $menus = \App\Models\Menu::with('items.children')->where('location', 'main')->first();
                    $menuItems = $menus?->items ?? collect([]);
                @endphp
                @forelse($menuItems as $item)
                    @if($item->children->count() > 0)
                        <!-- Dropdown Menu -->
                        <div class="relative" x-data="{ dropdownOpen: false }" 
                             @mouseenter="dropdownOpen = true" 
                             @mouseleave="dropdownOpen = false">
                            <button class="flex items-center space-x-1 px-4 py-2 text-gray-700 hover:text-[var(--color-primary)] transition font-medium {{ request()->routeIs($item->route) ? 'text-[var(--color-primary)]' : '' }}">
                                <span>{{ $item->title }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="dropdownOpen" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 translate-y-2"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 translate-y-2"
                                 class="absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-100 py-2 z-50">
                                @foreach($item->children as $child)
                                    <a href="{{ $child->url }}" 
                                       class="block px-4 py-2.5 text-gray-700 hover:bg-gray-50 hover:text-[var(--color-primary)] transition {{ request()->fullUrlIs($child->url) ? 'bg-gray-50 text-[var(--color-primary)] font-semibold' : '' }}">
                                        {{ $child->title }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{ $item->url }}" 
                           class="px-4 py-2 text-gray-700 hover:text-[var(--color-primary)] transition font-medium {{ request()->routeIs($item->route) || request()->fullUrlIs($item->url) ? 'text-[var(--color-primary)]' : '' }}">
                            {{ $item->title }}
                        </a>
                    @endif
                @empty
                    <a href="{{ route('home') }}" class="px-4 py-2 text-gray-700 hover:text-[var(--color-primary)] transition {{ request()->routeIs('home') ? 'text-[var(--color-primary)] font-semibold' : '' }}">Home</a>
                    <a href="{{ route('about') }}" class="px-4 py-2 text-gray-700 hover:text-[var(--color-primary)] transition {{ request()->routeIs('about') ? 'text-[var(--color-primary)] font-semibold' : '' }}">About</a>
                    <a href="{{ route('services.index') }}" class="px-4 py-2 text-gray-700 hover:text-[var(--color-primary)] transition {{ request()->routeIs('services.*') ? 'text-[var(--color-primary)] font-semibold' : '' }}">Services</a>
                    <a href="{{ route('blog') }}" class="px-4 py-2 text-gray-700 hover:text-[var(--color-primary)] transition {{ request()->routeIs('blog') ? 'text-[var(--color-primary)] font-semibold' : '' }}">Blog</a>
                    <a href="{{ route('careers') }}" class="px-4 py-2 text-gray-700 hover:text-[var(--color-primary)] transition {{ request()->routeIs('careers') ? 'text-[var(--color-primary)] font-semibold' : '' }}">Careers</a>
                    <a href="{{ route('contact') }}" class="px-4 py-2 text-gray-700 hover:text-[var(--color-primary)] transition {{ request()->routeIs('contact') ? 'text-[var(--color-primary)] font-semibold' : '' }}">Contact</a>
                @endforelse
            </div>

            <!-- CTA Button -->
            <div class="hidden md:flex items-center">
                <a href="{{ route('contact') }}" 
                   class="px-6 py-2.5 rounded-lg font-semibold transition shadow-md hover:shadow-lg"
                   style="background-color: var(--color-primary); color: white;">
                    Get Started
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-700 hover:text-[var(--color-primary)] focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         x-cloak
         class="md:hidden bg-white border-t border-gray-100 shadow-lg">
        <div class="px-4 py-3 space-y-2">
            @forelse($menuItems as $item)
                <a href="{{ $item->url }}" 
                   class="block px-4 py-2.5 text-gray-700 hover:bg-gray-50 hover:text-[var(--color-primary)] rounded-lg transition {{ request()->routeIs($item->route) || request()->fullUrlIs($item->url) ? 'bg-gray-50 text-[var(--color-primary)] font-semibold' : '' }}">
                    {{ $item->title }}
                </a>
            @empty
                <a href="{{ route('home') }}" class="block px-4 py-2.5 text-gray-700 hover:bg-gray-50 rounded-lg">Home</a>
                <a href="{{ route('about') }}" class="block px-4 py-2.5 text-gray-700 hover:bg-gray-50 rounded-lg">About</a>
                <a href="{{ route('services.index') }}" class="block px-4 py-2.5 text-gray-700 hover:bg-gray-50 rounded-lg">Services</a>
                <a href="{{ route('blog') }}" class="block px-4 py-2.5 text-gray-700 hover:bg-gray-50 rounded-lg">Blog</a>
                <a href="{{ route('careers') }}" class="block px-4 py-2.5 text-gray-700 hover:bg-gray-50 rounded-lg">Careers</a>
                <a href="{{ route('contact') }}" class="block px-4 py-2.5 text-gray-700 hover:bg-gray-50 rounded-lg">Contact</a>
            @endforelse
            <a href="{{ route('contact') }}" 
               class="block text-center px-4 py-3 rounded-lg font-semibold mt-4 shadow-md"
               style="background-color: var(--color-primary); color: white;">
                Get Started
            </a>
        </div>
    </div>
</nav>
