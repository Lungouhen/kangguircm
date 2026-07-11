@props(['testimonial'])

<div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300 border border-gray-100">
    <div class="flex items-center mb-4">
        <div class="text-yellow-400 flex">
            @for($i = 0; $i < 5; $i++)
                <svg class="w-5 h-5 @if($i >= ($testimonial->rating ?? 5)) text-gray-300 @endif" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
            @endfor
        </div>
    </div>
    
    <blockquote class="text-gray-700 italic mb-6 leading-relaxed">
        "{{ $testimonial->content }}"
    </blockquote>
    
    <div class="flex items-center">
        @if($testimonial->avatar)
            <img src="{{ $testimonial->avatar }}" alt="{{ $testimonial->name }}" class="w-12 h-12 rounded-full object-cover mr-4">
        @else
            <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mr-4">
                <span class="text-indigo-600 font-bold text-lg">{{ substr($testimonial->name, 0, 1) }}</span>
            </div>
        @endif
        
        <div>
            <p class="font-bold text-gray-900">{{ $testimonial->name }}</p>
            @if($testimonial->position)
                <p class="text-sm text-gray-600">{{ $testimonial->position }}</p>
            @endif
            @if($testimonial->company)
                <p class="text-sm text-indigo-600">{{ $testimonial->company }}</p>
            @endif
        </div>
    </div>
</div>
