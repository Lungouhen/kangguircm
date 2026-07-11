@extends('layouts.app')

@section('title', 'Home - Kanggui RCM')
@section('meta_description', 'Professional Revenue Cycle Management Solutions for Healthcare Providers')

@php
    $theme = \App\Models\Theme::active();
    $blocks = \App\Models\Block::forPage('home');
@endphp

@section('content')
    @if($blocks->count() > 0)
        @foreach($blocks as $block)
            <x-dynamic-block :block="$block" />
        @endforeach
    @else
        {{-- Fallback to static content if no blocks assigned --}}
        <!-- Default Hero Section -->
        <section class="relative bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-secondary)] text-white py-24 md:py-32 overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center max-w-4xl mx-auto">
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="font-family: var(--font-heading);">
                        Optimize Your Revenue Cycle with Confidence
                    </h1>
                    <p class="text-xl md:text-2xl text-white/90 mb-10 max-w-3xl mx-auto leading-relaxed">
                        Professional RCM solutions that help healthcare providers maximize revenue, reduce denials, and focus on what matters most—patient care.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('contact') }}" 
                           class="bg-white text-[var(--color-primary)] px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            Get Started Free
                        </a>
                        <a href="{{ route('services.index') }}" 
                           class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-[var(--color-primary)] transition">
                            Explore Services
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold mb-2" style="color: var(--color-primary); font-family: var(--font-heading);">98%</div>
                        <div class="text-gray-600">Claim Acceptance Rate</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold mb-2" style="color: var(--color-primary); font-family: var(--font-heading);">30%</div>
                        <div class="text-gray-600">Revenue Increase</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold mb-2" style="color: var(--color-primary); font-family: var(--font-heading);">24/7</div>
                        <div class="text-gray-600">Support Available</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold mb-2" style="color: var(--color-primary); font-family: var(--font-heading);">500+</div>
                        <div class="text-gray-600">Happy Clients</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4" style="font-family: var(--font-heading);">Our Comprehensive Services</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                        End-to-end revenue cycle management solutions tailored to your healthcare practice needs.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($services as $service)
                        <div class="bg-white rounded-xl p-8 hover:shadow-xl transition-all duration-300 group border border-gray-100">
                            @if($service->icon)
                                <div class="w-14 h-14 rounded-lg flex items-center justify-center mb-6 transition-colors" style="background-color: var(--color-primary);">
                                    <span class="text-white text-2xl">{{ $service->icon }}</span>
                                </div>
                            @endif
                            <h3 class="text-2xl font-semibold text-gray-900 mb-3 group-hover:text-[var(--color-primary)] transition" style="font-family: var(--font-heading);">{{ $service->name }}</h3>
                            <p class="text-gray-600 mb-6 leading-relaxed">{{ Str::limit($service->description, 120) }}</p>
                            <a href="{{ route('services.show', $service->slug) }}" 
                               class="inline-flex items-center text-[var(--color-primary)] hover:text-[var(--color-secondary)] font-semibold transition">
                                Learn more
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-gray-500">Services coming soon.</p>
                        </div>
                    @endforelse
                </div>

                <div class="text-center mt-12">
                    <a href="{{ route('services.index') }}" 
                       class="inline-block px-8 py-4 rounded-lg font-semibold transition shadow-md hover:shadow-lg"
                       style="background-color: var(--color-primary); color: white;">
                        View All Services
                    </a>
                </div>
            </div>
        </section>

        <!-- Why Choose Us -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4" style="font-family: var(--font-heading);">Why Leading Providers Choose Kanggui RCM</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                        We combine industry expertise with cutting-edge technology to deliver exceptional results.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="text-center p-6">
                        <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3" style="font-family: var(--font-heading);">Fast Implementation</h3>
                        <p class="text-gray-600 leading-relaxed">Get up and running quickly with our streamlined onboarding process.</p>
                    </div>

                    <div class="text-center p-6">
                        <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3" style="font-family: var(--font-heading);">99% Accuracy</h3>
                        <p class="text-gray-600 leading-relaxed">Minimize errors and denials with our precision-focused approach.</p>
                    </div>

                    <div class="text-center p-6">
                        <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3" style="font-family: var(--font-heading);">Increased Revenue</h3>
                        <p class="text-gray-600 leading-relaxed">Maximize your collections with our proven optimization strategies.</p>
                    </div>

                    <div class="text-center p-6">
                        <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3" style="font-family: var(--font-heading);">24/7 Support</h3>
                        <p class="text-gray-600 leading-relaxed">Round-the-clock assistance whenever you need it.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-white" style="font-family: var(--font-heading);">Ready to Transform Your Revenue Cycle?</h2>
                <p class="text-xl text-white/90 mb-10 max-w-2xl mx-auto leading-relaxed">
                    Contact us today for a free consultation and discover how we can help your practice thrive.
                </p>
                <a href="{{ route('contact') }}" 
                   class="inline-block bg-white text-[var(--color-primary)] px-10 py-4 rounded-lg font-semibold hover:bg-gray-100 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Schedule Your Free Consultation
                </a>
            </div>
        </section>
    @endif
@endsection
