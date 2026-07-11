@extends('layouts.app')

@section('title', 'Blog - Kanggui RCM')
@section('meta_description', 'Insights and best practices in Revenue Cycle Management')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold mb-4">Our Blog</h1>
            <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                Stay updated with the latest trends, insights, and best practices in revenue cycle management.
            </p>
        </div>
    </section>

    <!-- Blog Content -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @forelse($posts as $post)
                            <article class="bg-gray-50 rounded-lg overflow-hidden hover:shadow-lg transition border border-gray-100">
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
                                    @if($post->category)
                                        <span class="inline-block bg-blue-100 text-blue-600 text-xs px-2 py-1 rounded-full mb-2">{{ $post->category->name }}</span>
                                    @endif
                                    <h3 class="text-lg font-semibold mb-2 line-clamp-2">{{ $post->title }}</h3>
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit($post->excerpt, 100) }}</p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs text-gray-500">{{ $post->published_at->format('M d, Y') }}</span>
                                        <a href="{{ route('blog.show', $post->slug) }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                            Read more →
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="col-span-full text-center py-12">
                                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                                <p class="text-gray-500 text-lg">No blog posts available yet.</p>
                                <p class="text-gray-400 mt-2">Check back soon for new content!</p>
                            </div>
                        @endforelse
                    </div>

                    @if($posts->hasPages())
                        <div class="mt-12">
                            {{ $posts->links() }}
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Categories -->
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-semibold mb-4">Categories</h3>
                        <ul class="space-y-2">
                            @forelse($categories as $category)
                                <li>
                                    <a href="#" class="text-gray-600 hover:text-blue-600 text-sm flex items-center justify-between">
                                        <span>{{ $category->name }}</span>
                                        <span class="text-gray-400 text-xs">(0)</span>
                                    </a>
                                </li>
                            @empty
                                <li class="text-gray-500 text-sm">No categories available</li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- Newsletter Signup -->
                    <div class="bg-blue-600 rounded-lg p-6 text-white">
                        <h3 class="text-lg font-semibold mb-2">Subscribe to Our Newsletter</h3>
                        <p class="text-blue-100 text-sm mb-4">Get the latest insights delivered to your inbox.</p>
                        <form action="#" method="POST" class="space-y-3">
                            @csrf
                            <input 
                                type="email" 
                                placeholder="Your email address"
                                class="w-full px-3 py-2 rounded-lg text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-white"
                            >
                            <button 
                                type="submit" 
                                class="w-full bg-white text-blue-600 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-100 transition"
                            >
                                Subscribe
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Need Expert RCM Guidance?</h2>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                Our team of experts is ready to help you optimize your revenue cycle.
            </p>
            <a href="{{ route('contact') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                Contact Us Today
            </a>
        </div>
    </section>
@endsection
