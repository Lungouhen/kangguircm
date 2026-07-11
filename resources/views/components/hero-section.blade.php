@props([
    'title' => null,
    'subtitle' => null,
    'description' => null,
    'image' => null,
    'ctaText' => null,
    'ctaLink' => null,
    'centered' => true,
    'overlay' => true
])

<section class="relative h-[600px] flex items-center @if($centered) justify-center @else justify-start @endif overflow-hidden">
    @if($image)
        <div class="absolute inset-0">
            <img src="{{ $image }}" alt="Hero background" class="w-full h-full object-cover">
            @if($overlay)
                <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/50"></div>
            @endif
        </div>
    @else
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-900 to-indigo-700"></div>
    @endif
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center @if(!$centered) text-left @endif">
        @if($subtitle)
            <p class="text-indigo-300 font-semibold tracking-wide uppercase mb-4 animate-fade-in">{{ $subtitle }}</p>
        @endif
        
        @if($title)
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight animate-fade-in-up">
                {!! $title !!}
            </h1>
        @endif
        
        @if($description)
            <p class="text-xl md:text-2xl text-gray-200 mb-8 max-w-3xl @if($centered) mx-auto @endif animate-fade-in-up delay-100">
                {{ $description }}
            </p>
        @endif
        
        @if($ctaText && $ctaLink)
            <div class="animate-fade-in-up delay-200">
                <a href="{{ $ctaLink }}" class="inline-flex items-center px-8 py-4 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 transition-all transform hover:scale-105 shadow-lg hover:shadow-xl">
                    {{ $ctaText }}
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>
        @endif
    </div>
</section>

@push('styles')
<style>
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-fade-in { animation: fadeIn 0.8s ease-out forwards; }
    .animate-fade-in-up { animation: fadeInUp 0.8s ease-out forwards; }
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
</style>
@endpush
