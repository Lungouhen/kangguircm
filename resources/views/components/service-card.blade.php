@props(['service'])

<div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 border border-gray-100">
    @if($service->image)
        <div class="h-48 mb-6 rounded-md overflow-hidden">
            <img src="{{ $service->image }}" alt="{{ $service->title }}" class="w-full h-full object-cover">
        </div>
    @endif
    
    <div class="flex items-center mb-4">
        @if($service->icon)
            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mr-4">
                <i class="{{ $service->icon }} text-indigo-600 text-xl"></i>
            </div>
        @endif
        <h3 class="text-xl font-bold text-gray-900">{{ $service->title }}</h3>
    </div>
    
    <p class="text-gray-600 mb-4 line-clamp-3">{{ $service->description }}</p>
    
    <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center text-indigo-600 font-semibold hover:text-indigo-700">
        Learn more
        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </a>
</div>
