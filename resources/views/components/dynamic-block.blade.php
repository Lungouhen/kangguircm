@props(['block'])

@php
    $layoutVariant = $block->layout_variant ?? 'standard';
    
    $backgroundClass = match($block->background_type) {
        'color' => 'bg-' . $block->background_value,
        'gradient' => 'bg-gradient-to-r ' . $block->background_value,
        'image' => 'bg-cover bg-center bg-no-repeat',
        default => 'bg-white',
    };

    $bgStyle = $block->background_type === 'image' && $block->background_value
        ? "background-image: url('" . asset('storage/' . $block->background_value) . "');"
        : '';
    
    $sectionClasses = match($layoutVariant) {
        'full-width' => 'w-full px-4 sm:px-6 lg:px-8',
        default => 'max-w-7xl mx-auto px-4 sm:px-6 lg:px-8',
    };
@endphp

<section class="{{ $block->padding ?? 'py-16' }} {{ $backgroundClass }}" style="{{ $bgStyle }}">
    <div class="{{ $sectionClasses }}">
        @switch($block->type)
            @case('hero')
                <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white">
                    <div class="absolute inset-0 bg-[url('/img/pattern.svg')] opacity-10"></div>
                    <div class="relative px-8 py-20 md:px-16 md:py-32">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight mb-6">
                            {{ $block->content['title'] ?? 'Transform Your Business' }}
                        </h1>
                        @if(isset($block->content['subtitle']))
                            <p class="text-xl md:text-2xl text-blue-100 mb-8 max-w-3xl">
                                {{ $block->content['subtitle'] }}
                            </p>
                        @endif
                        @if(isset($block->content['description']))
                            <p class="text-lg text-blue-50 mb-10 max-w-2xl">
                                {{ $block->content['description'] }}
                            </p>
                        @endif
                        @if(isset($block->content['cta_text']))
                            <a href="{{ $block->content['cta_link'] ?? '#' }}"
                               class="inline-flex items-center px-8 py-4 bg-white text-blue-700 font-semibold rounded-lg hover:bg-blue-50 transition shadow-lg">
                                {{ $block->content['cta_text'] }}
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
                @break

            @case('features')
                @if($layoutVariant === 'alternating')
                    <div class="space-y-20">
                        @foreach(($block->content['items'] ?? []) as $index => $feature)
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center {{ $index % 2 === 1 ? 'lg:flex-row-reverse' : '' }}">
                                <div class="{{ $index % 2 === 1 ? 'lg:order-2' : '' }}">
                                    @if(isset($feature['icon']))
                                        <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6">
                                            <span class="text-3xl">{!! $feature['icon'] !!}</span>
                                        </div>
                                    @endif
                                    <h3 class="text-3xl font-bold text-gray-900 mb-4">{{ $feature['title'] ?? '' }}</h3>
                                    <p class="text-lg text-gray-600 leading-relaxed">{{ $feature['description'] ?? '' }}</p>
                                    @if(isset($feature['link']))
                                        <a href="{{ $feature['link'] }}" class="mt-6 inline-flex items-center text-blue-600 font-semibold hover:text-blue-700">
                                            Learn more
                                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                                @if(isset($feature['image']))
                                    <div class="{{ $index % 2 === 1 ? 'lg:order-1' : '' }}">
                                        <img src="{{ asset('storage/' . $feature['image']) }}" alt="{{ $feature['title'] }}" 
                                             class="rounded-2xl shadow-2xl w-full object-cover h-[400px]">
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @elseif($layoutVariant === 'grid-4')
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        @foreach(($block->content['items'] ?? []) as $feature)
                            <div class="group p-8 bg-white rounded-2xl border border-gray-100 hover:border-blue-200 hover:shadow-xl transition">
                                @if(isset($feature['icon']))
                                    <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-blue-600 transition">
                                        <span class="text-2xl text-blue-600 group-hover:text-white transition">{!! $feature['icon'] !!}</span>
                                    </div>
                                @endif
                                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $feature['title'] ?? '' }}</h3>
                                <p class="text-gray-600 leading-relaxed">{{ $feature['description'] ?? '' }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach(($block->content['items'] ?? []) as $feature)
                            <div class="group p-8 bg-white rounded-2xl border border-gray-100 hover:border-blue-200 hover:shadow-xl transition">
                                @if(isset($feature['icon']))
                                    <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-blue-600 transition">
                                        <span class="text-2xl text-blue-600 group-hover:text-white transition">{!! $feature['icon'] !!}</span>
                                    </div>
                                @endif
                                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $feature['title'] ?? '' }}</h3>
                                <p class="text-gray-600 leading-relaxed">{{ $feature['description'] ?? '' }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
                @break

            @case('services')
                @if($layoutVariant === 'grid-4')
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach(($block->content['services'] ?? []) as $serviceData)
                            <x-service-card :service="(object)$serviceData" />
                        @endforeach
                    </div>
                @elseif($layoutVariant === 'alternating')
                    <div class="space-y-16">
                        @foreach(($block->content['services'] ?? []) as $index => $serviceData)
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center {{ $index % 2 === 1 ? 'lg:flex-row-reverse' : '' }}">
                                <div class="{{ $index % 2 === 1 ? 'lg:order-2' : '' }}">
                                    <h3 class="text-3xl font-bold text-gray-900 mb-4">{{ $serviceData['title'] ?? '' }}</h3>
                                    <p class="text-lg text-gray-600 leading-relaxed mb-6">{{ $serviceData['description'] ?? '' }}</p>
                                    <ul class="space-y-3">
                                        @foreach(($serviceData['features'] ?? []) as $feat)
                                            <li class="flex items-start">
                                                <svg class="w-6 h-6 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span class="text-gray-700">{{ $feat }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @if(isset($serviceData['image']))
                                    <div class="{{ $index % 2 === 1 ? 'lg:order-1' : '' }}">
                                        <img src="{{ asset('storage/' . $serviceData['image']) }}" alt="{{ $serviceData['title'] }}" 
                                             class="rounded-2xl shadow-xl w-full object-cover h-[350px]">
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach(($block->content['services'] ?? []) as $serviceData)
                            <x-service-card :service="(object)$serviceData" />
                        @endforeach
                    </div>
                @endif
                @break

            @case('testimonials')
                @if($layoutVariant === 'grid-4')
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach(($block->content['items'] ?? []) as $testimonial)
                            <x-testimonial-card :testimonial="(object)$testimonial" />
                        @endforeach
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach(($block->content['items'] ?? []) as $testimonial)
                            <x-testimonial-card :testimonial="(object)$testimonial" />
                        @endforeach
                    </div>
                @endif
                @break

            @case('team')
                @if($layoutVariant === 'grid-4')
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        @foreach(($block->content['members'] ?? []) as $member)
                            <x-team-member :member="(object)$member" />
                        @endforeach
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach(($block->content['members'] ?? []) as $member)
                            <x-team-member :member="(object)$member" />
                        @endforeach
                    </div>
                @endif
                @break

            @case('cta')
                <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
                    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white opacity-10 rounded-full"></div>
                    <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-64 h-64 bg-white opacity-10 rounded-full"></div>
                    <div class="relative px-8 py-16 md:px-16 md:py-20 text-center">
                        <h2 class="text-3xl md:text-4xl font-bold mb-6">{{ $block->content['title'] ?? 'Get Started Today' }}</h2>
                        <p class="text-xl text-blue-100 mb-10 max-w-2xl mx-auto">{{ $block->content['description'] ?? 'Contact us for a free consultation' }}</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ $block->content['button_link'] ?? route('contact') }}"
                               class="inline-flex items-center justify-center px-8 py-4 bg-white text-blue-700 font-semibold rounded-lg hover:bg-blue-50 transition shadow-lg">
                                {{ $block->content['button_text'] ?? 'Contact Us' }}
                            </a>
                            @if(isset($block->content['secondary_button_text']))
                                <a href="{{ $block->content['secondary_button_link'] ?? '#' }}"
                                   class="inline-flex items-center justify-center px-8 py-4 bg-transparent border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-blue-700 transition">
                                    {{ $block->content['secondary_button_text'] }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @break

            @case('stats')
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    @foreach(($block->content['stats'] ?? []) as $stat)
                        <div class="text-center p-6 bg-white rounded-2xl shadow-sm border border-gray-100">
                            <div class="text-4xl md:text-5xl font-bold text-blue-600 mb-2">{{ $stat['value'] ?? '0' }}</div>
                            <div class="text-gray-600 font-medium">{{ $stat['label'] ?? '' }}</div>
                        </div>
                    @endforeach
                </div>
                @break

            @case('faq')
                <div class="max-w-4xl mx-auto space-y-4" x-data="{ selected: null }">
                    @foreach(($block->content['items'] ?? []) as $index => $faq)
                        <div class="border border-gray-200 rounded-2xl overflow-hidden">
                            <button @click="selected = selected === {{ $index }} ? null : {{ $index }}"
                                    class="w-full px-8 py-6 text-left flex justify-between items-center bg-white hover:bg-gray-50 transition">
                                <span class="font-semibold text-lg text-gray-900 pr-8">{{ $faq['question'] ?? '' }}</span>
                                <svg class="w-6 h-6 text-blue-600 flex-shrink-0 transition-transform" :class="selected === {{ $index }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="selected === {{ $index }}" 
                                 x-collapse
                                 class="px-8 pb-6 pt-2 text-gray-600 leading-relaxed bg-gray-50">
                                {{ $faq['answer'] ?? '' }}
                            </div>
                        </div>
                    @endforeach
                </div>
                @break

            @default
                <div class="prose prose-lg max-w-none">
                    {!! $block->content !!}
                </div>
        @endswitch
    </div>
</section>
