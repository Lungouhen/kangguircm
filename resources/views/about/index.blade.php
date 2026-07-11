@extends('layouts.app')

@section('title', 'About Us - Kanggui RCM')
@section('meta_description', 'Learn about Kanggui RCM - Your trusted partner in Revenue Cycle Management')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold mb-4">About Kanggui RCM</h1>
            <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                Empowering healthcare providers with innovative revenue cycle solutions
            </p>
        </div>
    </section>

    <!-- Our Story -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Story</h2>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        Kanggui RCM was founded with a simple mission: to help healthcare providers focus on what they do best—providing exceptional patient care—while we handle the complexities of revenue cycle management.
                    </p>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        With years of experience in healthcare finance and a deep understanding of the challenges faced by medical practices, our team has developed comprehensive solutions that streamline operations, reduce denials, and maximize revenue.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        Today, we partner with healthcare providers across the country, delivering measurable results and peace of mind through our expert RCM services.
                    </p>
                </div>
                <div class="bg-gray-100 rounded-lg h-80 flex items-center justify-center">
                    <svg class="w-24 h-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-lg p-8 shadow-sm">
                    <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Our Mission</h3>
                    <p class="text-gray-600 leading-relaxed">
                        To provide healthcare providers with innovative, reliable, and efficient revenue cycle management solutions that optimize financial performance while allowing them to focus on delivering exceptional patient care.
                    </p>
                </div>
                <div class="bg-white rounded-lg p-8 shadow-sm">
                    <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Our Vision</h3>
                    <p class="text-gray-600 leading-relaxed">
                        To be the most trusted and innovative RCM partner for healthcare providers, recognized for our commitment to excellence, integrity, and continuous improvement in healthcare financial management.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Core Values</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    The principles that guide everything we do
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Excellence</h3>
                    <p class="text-gray-600">We strive for excellence in every aspect of our service delivery.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Integrity</h3>
                    <p class="text-gray-600">We operate with honesty, transparency, and ethical standards.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Collaboration</h3>
                    <p class="text-gray-600">We work as partners with our clients to achieve shared success.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Innovation</h3>
                    <p class="text-gray-600">We continuously improve and adapt to serve you better.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-blue-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Ready to Partner With Us?</h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Discover how Kanggui RCM can transform your revenue cycle management.
            </p>
            <a href="{{ route('contact') }}" class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                Get in Touch
            </a>
        </div>
    </section>
@endsection
