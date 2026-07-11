@props(['feature'])

<div class="flex items-start">
    <div class="flex-shrink-0">
        @if($feature->icon)
            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                <i class="{{ $feature->icon }} text-indigo-600 text-xl"></i>
            </div>
        @else
            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
        @endif
    </div>
    
    <div class="ml-4">
        <h4 class="text-lg font-bold text-gray-900 mb-2">{{ $feature->title }}</h4>
        <p class="text-gray-600">{{ $feature->description }}</p>
    </div>
</div>
