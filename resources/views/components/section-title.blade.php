@props(['title', 'subtitle' => null, 'centered' => false])

<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="@if($centered) text-center @endif">
            @if($subtitle)
                <p class="text-indigo-600 font-semibold tracking-wide uppercase mb-2">{{ $subtitle }}</p>
            @endif
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $title }}</h2>
            <div class="@if($centered) mx-auto @endif w-20 h-1 bg-indigo-600"></div>
        </div>
    </div>
</section>
