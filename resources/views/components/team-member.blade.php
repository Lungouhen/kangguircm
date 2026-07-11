@props(['member'])

<div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
    <div class="relative overflow-hidden">
        @if($member->photo)
            <img src="{{ $member->photo }}" alt="{{ $member->name }}" class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
        @else
            <div class="w-full h-64 bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                <span class="text-white text-6xl font-bold">{{ substr($member->name, 0, 1) }}</span>
            </div>
        @endif
        
        <!-- Social Links Overlay -->
        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
            <div class="flex space-x-4">
                @if($member->linkedin)
                    <a href="{{ $member->linkedin }}" target="_blank" class="w-10 h-10 bg-white rounded-full flex items-center justify-center hover:bg-indigo-600 transition-colors">
                        <svg class="w-5 h-5 text-gray-800 hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                        </svg>
                    </a>
                @endif
                @if($member->twitter)
                    <a href="{{ $member->twitter }}" target="_blank" class="w-10 h-10 bg-white rounded-full flex items-center justify-center hover:bg-indigo-600 transition-colors">
                        <svg class="w-5 h-5 text-gray-800 hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                        </svg>
                    </a>
                @endif
                @if($member->email)
                    <a href="mailto:{{ $member->email }}" class="w-10 h-10 bg-white rounded-full flex items-center justify-center hover:bg-indigo-600 transition-colors">
                        <svg class="w-5 h-5 text-gray-800 hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </a>
                @endif
            </div>
        </div>
    </div>
    
    <div class="p-6 text-center">
        <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $member->name }}</h3>
        @if($member->position)
            <p class="text-indigo-600 font-semibold mb-2">{{ $member->position }}</p>
        @endif
        @if($member->bio)
            <p class="text-gray-600 text-sm line-clamp-3">{{ $member->bio }}</p>
        @endif
    </div>
</div>
