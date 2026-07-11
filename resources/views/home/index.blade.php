@extends('layouts.app')

@section('title', 'Home - Kanggui RCM')
@section('meta_description', 'Professional Revenue Cycle Management Solutions for Healthcare Providers')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">
                    Optimize Your Revenue Cycle
                </h1>
                <p class="text-xl md:text-2xl text-blue-100 mb-8 max-w-3xl mx-auto">
                    Professional RCM solutions that help healthcare providers maximize revenue, reduce denials, and focus on patient care.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('contact') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                        Get Started
                    </a>
                    <a href="{{ route('services.index') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition">
                        Our Services
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Services</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Comprehensive revenue cycle management solutions tailored to your healthcare practice needs.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($services as $service)
                    <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition">
                        @if($service->icon)
                            <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mb-4">
                                <span class="text-white text-2xl">{{ $service->icon }}</span>
                            </div>
                        @endif
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $service->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($service->description, 120) }}</p>
                        <a href="{{ route('services.show', $service->slug) }}" class="text-blue-600 hover:text-blue-700 font-medium">
                            Learn more →
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500">Services coming soon.</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('services.index') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    View All Services
                </a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Why Choose Kanggui RCM?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    We combine industry expertise with cutting-edge technology to deliver exceptional results.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Fast Implementation</h3>
                    <p class="text-gray-600">Get up and running quickly with our streamlined onboarding process.</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">99% Accuracy</h3>
                    <p class="text-gray-600">Minimize errors and denials with our precision-focused approach.</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Increased Revenue</h3>
                    <p class="text-gray-600">Maximize your collections with our proven optimization strategies.</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">24/7 Support</h3>
                    <p class="text-gray-600">Round-the-clock assistance whenever you need it.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Blog Posts -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Latest Insights</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Stay updated with the latest trends and best practices in revenue cycle management.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($latestPosts as $post)
                    <article class="bg-gray-50 rounded-lg overflow-hidden hover:shadow-lg transition">
                        @if($post->featured_image)
                            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </div>
                        @endif
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">{{ $post->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($post->excerpt, 100) }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">{{ $post->published_at->format('M d, Y') }}</span>
                                <a href="{{ route('blog.show', $post->slug) }}" class="text-blue-600 hover:text-blue-700 font-medium">
                                    Read more →
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500">Blog posts coming soon.</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('blog') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    View All Posts
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-blue-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Ready to Optimize Your Revenue Cycle?</h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Contact us today for a free consultation and discover how we can help your practice thrive.
            </p>
            <a href="{{ route('contact') }}" class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                Schedule a Consultation
            </a>
        </div>
    </section>
@endsection
