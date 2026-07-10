@extends('layouts.app')

@section('title', $post->title . ' - Kanggui RCM')
@section('meta_description', Str::limit($post->excerpt, 160))

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center space-x-2 text-sm mb-4">
                <a href="{{ route('home') }}" class="text-blue-100 hover:text-white">Home</a>
                <span class="text-blue-200">/</span>
                <a href="{{ route('blog') }}" class="text-blue-100 hover:text-white">Blog</a>
                <span class="text-blue-200">/</span>
                <span class="text-white">{{ $post->title }}</span>
            </nav>
            <h1 class="text-4xl font-bold mb-4">{{ $post->title }}</h1>
            <div class="flex items-center space-x-4 text-blue-100 text-sm">
                @if($post->author)
                    <span>By {{ $post->author->name }}</span>
                @endif
                <span>•</span>
                <span>{{ $post->published_at->format('F d, Y') }}</span>
                <span>•</span>
                <span>{{ $post->views_count }} views</span>
            </div>
        </div>
    </section>

    <!-- Post Content -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    @if($post->featured_image)
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-96 object-cover rounded-lg mb-8">
                    @endif

                    @if($post->excerpt)
                        <p class="text-xl text-gray-600 mb-8 leading-relaxed">{{ $post->excerpt }}</p>
                    @endif

                    <div class="prose prose-blue max-w-none">
                        {!! nl2br(e($post->content)) !!}
                    </div>

                    <!-- Share Buttons -->
                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <h3 class="text-lg font-semibold mb-4">Share this article</h3>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white hover:bg-blue-700 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-blue-800 rounded-full flex items-center justify-center text-white hover:bg-blue-900 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center text-white hover:bg-green-700 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3 8h-1.35c-.538 0-.65.221-.65.778v1.222h2l-.209 2h-1.791v7h-3v-7h-2v-2h2v-2.308c0-1.769.931-2.692 3.029-2.692 1.22 0 1.87.092 2.171.132v2.868z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-50 rounded-lg p-6 sticky top-4">
                        @if($post->category)
                            <div class="mb-6">
                                <span class="inline-block bg-blue-100 text-blue-600 text-xs px-3 py-1 rounded-full mb-3">{{ $post->category->name }}</span>
                            </div>
                        @endif

                        <h3 class="text-lg font-semibold mb-4">Related Articles</h3>
                        <div class="space-y-4">
                            @forelse($relatedPosts as $related)
                                <a href="{{ route('blog.show', $related->slug) }}" class="block group">
                                    <div class="flex space-x-3">
                                        @if($related->featured_image)
                                            <img src="{{ asset('storage/' . $related->featured_image) }}" alt="{{ $related->title }}" class="w-20 h-20 object-cover rounded flex-shrink-0">
                                        @else
                                            <div class="w-20 h-20 bg-gray-200 rounded flex items-center justify-center flex-shrink-0">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-900 group-hover:text-blue-600 line-clamp-2">{{ $related->title }}</h4>
                                            <span class="text-xs text-gray-500">{{ $related->published_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <p class="text-gray-500 text-sm">No related articles available.</p>
                            @endforelse
                        </div>

                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <a href="{{ route('contact') }}" class="block w-full bg-blue-600 text-white text-center px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                                Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-blue-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Need Help with Your Revenue Cycle?</h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Our experts are here to help you optimize your processes and maximize revenue.
            </p>
            <a href="{{ route('contact') }}" class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                Get in Touch
            </a>
        </div>
    </section>
@endsection
