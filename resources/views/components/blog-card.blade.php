@props(['post'])

<article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
    @if($post->featured_image)
        <div class="h-48 overflow-hidden">
            <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
        </div>
    @endif
    
    <div class="p-6">
        <div class="flex items-center text-sm text-gray-500 mb-3">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            {{ $post->created_at->format('M d, Y') }}
            @if($post->category)
                <span class="mx-2">•</span>
                <span class="text-indigo-600 font-medium">{{ $post->category }}</span>
            @endif
        </div>
        
        <h3 class="text-xl font-bold text-gray-900 mb-2 hover:text-indigo-600 transition-colors">
            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
        </h3>
        
        <p class="text-gray-600 mb-4 line-clamp-2">{{ Str::limit($post->excerpt ?: strip_tags($post->content), 120) }}</p>
        
        <div class="flex items-center justify-between">
            @if($post->author)
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center mr-2">
                        <span class="text-indigo-600 font-semibold text-sm">{{ substr($post->author, 0, 1) }}</span>
                    </div>
                    <span class="text-sm text-gray-600">{{ $post->author }}</span>
                </div>
            @endif
            
            <a href="{{ route('blog.show', $post->slug) }}" class="text-indigo-600 font-semibold hover:text-indigo-700 text-sm">
                Read more →
            </a>
        </div>
    </div>
</article>
