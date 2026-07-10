@extends('layouts.app')

@section('title', 'Services - Kanggui RCM')
@section('meta_description', 'Comprehensive Revenue Cycle Management Services')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold mb-4">Our Services</h1>
            <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                Comprehensive revenue cycle management solutions designed to maximize your healthcare practice's financial performance.
            </p>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($services as $service)
                    <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition border border-gray-100">
                        @if($service->icon)
                            <div class="w-14 h-14 bg-blue-600 rounded-lg flex items-center justify-center mb-4">
                                <span class="text-white text-2xl">{{ $service->icon }}</span>
                            </div>
                        @endif
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $service->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($service->description, 150) }}</p>
                        <a href="{{ route('services.show', $service->slug) }}" class="inline-block text-blue-600 hover:text-blue-700 font-medium">
                            Learn more →
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        <p class="text-gray-500 text-lg">No services available at this time.</p>
                        <p class="text-gray-400 mt-2">Please check back later.</p>
                    </div>
                @endforelse
            </div>

            @if($services->hasPages())
                <div class="mt-12">
                    {{ $services->links() }}
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-blue-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Need a Custom Solution?</h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                We offer tailored RCM solutions to meet your specific needs. Contact us today!
            </p>
            <a href="{{ route('contact') }}" class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                Get in Touch
            </a>
        </div>
    </section>
@endsection
