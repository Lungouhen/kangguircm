@extends('layouts.app')

@section('title', $service->name . ' - Kanggui RCM')
@section('meta_description', Str::limit($service->description, 160))

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center space-x-2 text-sm mb-4">
                <a href="{{ route('home') }}" class="text-blue-100 hover:text-white">Home</a>
                <span class="text-blue-200">/</span>
                <a href="{{ route('services.index') }}" class="text-blue-100 hover:text-white">Services</a>
                <span class="text-blue-200">/</span>
                <span class="text-white">{{ $service->name }}</span>
            </nav>
            <h1 class="text-4xl font-bold">{{ $service->name }}</h1>
        </div>
    </section>

    <!-- Service Content -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    @if($service->icon)
                        <div class="w-16 h-16 bg-blue-600 rounded-lg flex items-center justify-center mb-6">
                            <span class="text-white text-3xl">{{ $service->icon }}</span>
                        </div>
                    @endif
                    
                    <div class="prose prose-blue max-w-none">
                        {!! nl2br(e($service->content)) !!}
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-50 rounded-lg p-6 sticky top-4">
                        <h3 class="text-lg font-semibold mb-4">Contact Us</h3>
                        <p class="text-gray-600 mb-6">
                            Interested in {{ $service->name }}? Get in touch with our team for a consultation.
                        </p>
                        <a href="{{ route('contact') }}" class="block w-full bg-blue-600 text-white text-center px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition mb-4">
                            Request Consultation
                        </a>
                        <a href="tel:+1234567890" class="block w-full border-2 border-blue-600 text-blue-600 text-center px-6 py-3 rounded-lg font-semibold hover:bg-blue-50 transition">
                            Call Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Services -->
    @if($relatedServices->isNotEmpty())
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold mb-8">Related Services</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedServices as $related)
                        <div class="bg-white rounded-lg p-6 hover:shadow-md transition border border-gray-100">
                            @if($related->icon)
                                <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mb-3">
                                    <span class="text-white text-xl">{{ $related->icon }}</span>
                                </div>
                            @endif
                            <h3 class="text-lg font-semibold mb-2">{{ $related->name }}</h3>
                            <p class="text-gray-600 text-sm mb-3">{{ Str::limit($related->description, 80) }}</p>
                            <a href="{{ route('services.show', $related->slug) }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                Learn more →
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- CTA Section -->
    <section class="py-16 bg-blue-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Ready to Get Started?</h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Contact us today to learn how {{ $service->name }} can benefit your practice.
            </p>
            <a href="{{ route('contact') }}" class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                Schedule a Consultation
            </a>
        </div>
    </section>
@endsection
