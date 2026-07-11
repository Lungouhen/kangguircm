@props(['block'])

@php
    $backgroundClass = match($block->background_type) {
        'color' => 'bg-' . $block->background_value,
        'gradient' => 'bg-gradient-to-r ' . $block->background_value,
        'image' => 'bg-cover bg-center bg-no-repeat',
        default => '',
    };
    
    $bgStyle = $block->background_type === 'image' && $block->background_value 
        ? "background-image: url('" . asset('storage/' . $block->background_value) . "');" 
        : '';
@endphp

<section class="{{ $block->padding }} {{ $backgroundClass }}" style="{{ $bgStyle }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @switch($block->type)
            @case('hero')
                <x-hero-section 
                    :title="$block->content['title'] ?? ''"
                    :subtitle="$block->content['subtitle'] ?? null"
                    :description="$block->content['description'] ?? null"
                    :ctaText="$block->content['cta_text'] ?? null"
                    :ctaLink="$block->content['cta_link'] ?? '#'"
                    :centered="($block->content['centered'] ?? true)"
                />
                @break

            @case('features')
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach(($block->content['items'] ?? []) as $feature)
                        <x-feature-item :feature="(object)$feature" />
                    @endforeach
                </div>
                @break

            @case('services')
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach(($block->content['services'] ?? []) as $serviceData)
                        <x-service-card :service="(object)$serviceData" />
                    @endforeach
                </div>
                @break

            @case('testimonials')
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach(($block->content['items'] ?? []) as $testimonial)
                        <x-testimonial-card :testimonial="(object)$testimonial" />
                    @endforeach
                </div>
                @break

            @case('team')
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach(($block->content['members'] ?? []) as $member)
                        <x-team-member :member="(object)$member" />
                    @endforeach
                </div>
                @break

            @case('cta')
                <div class="text-center {{ $block->content['bg_color'] ?? 'bg-blue-600' }} text-white rounded-lg p-12">
                    <h2 class="text-3xl font-bold mb-4">{{ $block->content['title'] ?? 'Get Started Today' }}</h2>
                    <p class="text-xl mb-8">{{ $block->content['description'] ?? 'Contact us for a free consultation' }}</p>
                    <a href="{{ $block->content['button_link'] ?? route('contact') }}" 
                       class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                        {{ $block->content['button_text'] ?? 'Contact Us' }}
                    </a>
                </div>
                @break

            @case('stats')
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    @foreach(($block->content['stats'] ?? []) as $stat)
                        <div>
                            <div class="text-4xl font-bold text-blue-600 mb-2">{{ $stat['value'] ?? '0' }}</div>
                            <div class="text-gray-600">{{ $stat['label'] ?? '' }}</div>
                        </div>
                    @endforeach
                </div>
                @break

            @case('faq')
                <div class="space-y-4" x-data="{ selected: null }">
                    @foreach(($block->content['items'] ?? []) as $index => $faq)
                        <div class="border border-gray-200 rounded-lg">
                            <button @click="selected = selected === {{ $index }} ? null : {{ $index }}"
                                    class="w-full px-6 py-4 text-left flex justify-between items-center">
                                <span class="font-semibold">{{ $faq['question'] ?? '' }}</span>
                                <svg class="w-5 h-5 transition-transform" :class="selected === {{ $index }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="selected === {{ $index }}" class="px-6 pb-4 text-gray-600">
                                {{ $faq['answer'] ?? '' }}
                            </div>
                        </div>
                    @endforeach
                </div>
                @break

            @default
                <div class="prose max-w-none">
                    {!! $block->content['html'] ?? '' !!}
                </div>
        @endswitch
    </div>
</section>
