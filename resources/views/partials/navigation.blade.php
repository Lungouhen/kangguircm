<nav class="bg-white shadow-sm border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <span class="text-2xl font-bold text-blue-600">Kanggui RCM</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 transition {{ request()->routeIs('home') ? 'text-blue-600 font-semibold' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="text-gray-700 hover:text-blue-600 transition {{ request()->routeIs('about') ? 'text-blue-600 font-semibold' : '' }}">About</a>
                <a href="{{ route('services.index') }}" class="text-gray-700 hover:text-blue-600 transition {{ request()->routeIs('services.*') ? 'text-blue-600 font-semibold' : '' }}">Services</a>
                <a href="{{ route('blog') }}" class="text-gray-700 hover:text-blue-600 transition {{ request()->routeIs('blog') ? 'text-blue-600 font-semibold' : '' }}">Blog</a>
                <a href="{{ route('careers') }}" class="text-gray-700 hover:text-blue-600 transition {{ request()->routeIs('careers') ? 'text-blue-600 font-semibold' : '' }}">Careers</a>
                <a href="{{ route('contact') }}" class="text-gray-700 hover:text-blue-600 transition {{ request()->routeIs('contact') ? 'text-blue-600 font-semibold' : '' }}">Contact</a>
            </div>

            <!-- CTA Button -->
            <div class="hidden md:flex items-center">
                <a href="{{ route('contact') }}" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition font-medium">
                    Get Started
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-btn" class="text-gray-700 hover:text-blue-600 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100">
        <div class="px-4 py-3 space-y-3">
            <a href="{{ route('home') }}" class="block text-gray-700 hover:text-blue-600 {{ request()->routeIs('home') ? 'text-blue-600 font-semibold' : '' }}">Home</a>
            <a href="{{ route('about') }}" class="block text-gray-700 hover:text-blue-600 {{ request()->routeIs('about') ? 'text-blue-600 font-semibold' : '' }}">About</a>
            <a href="{{ route('services.index') }}" class="block text-gray-700 hover:text-blue-600 {{ request()->routeIs('services.*') ? 'text-blue-600 font-semibold' : '' }}">Services</a>
            <a href="{{ route('blog') }}" class="block text-gray-700 hover:text-blue-600 {{ request()->routeIs('blog') ? 'text-blue-600 font-semibold' : '' }}">Blog</a>
            <a href="{{ route('careers') }}" class="block text-gray-700 hover:text-blue-600 {{ request()->routeIs('careers') ? 'text-blue-600 font-semibold' : '' }}">Careers</a>
            <a href="{{ route('contact') }}" class="block text-gray-700 hover:text-blue-600 {{ request()->routeIs('contact') ? 'text-blue-600 font-semibold' : '' }}">Contact</a>
            <a href="{{ route('contact') }}" class="block bg-blue-600 text-white text-center px-4 py-2 rounded-lg hover:bg-blue-700 mt-4">
                Get Started
            </a>
        </div>
    </div>
</nav>

@push('scripts')
<script>
document.getElementById('mobile-menu-btn').addEventListener('click', function() {
    const menu = document.getElementById('mobile-menu');
    menu.classList.toggle('hidden');
});
</script>
@endpush
