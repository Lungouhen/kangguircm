@props(['job'])

<div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300 border-l-4 border-indigo-600">
    <div class="flex justify-between items-start mb-4">
        <div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $job->title }}</h3>
            <div class="flex flex-wrap gap-2 text-sm text-gray-600">
                @if($job->location)
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        {{ $job->location }}
                    </span>
                @endif
                
                @if($job->type)
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        {{ $job->type }}
                    </span>
                @endif
                
                @if($job->salary_range)
                    <span class="flex items-center text-green-600 font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ $job->salary_range }}
                    </span>
                @endif
            </div>
        </div>
        
        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
            @if($job->status === 'active') bg-green-100 text-green-800 
            @elseif($job->status === 'urgent') bg-red-100 text-red-800 
            @else bg-gray-100 text-gray-800 @endif">
            {{ ucfirst($job->status ?? 'Active') }}
        </span>
    </div>
    
    <p class="text-gray-600 mb-4 line-clamp-2">{{ Str::limit($job->description, 150) }}</p>
    
    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
        <span class="text-sm text-gray-500">
            Posted {{ $job->created_at->diffForHumans() }}
        </span>
        
        <a href="{{ route('careers.show', $job->slug) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition-colors">
            Apply Now
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
        </a>
    </div>
</div>
