@extends('layouts.app')

@section('title', $job->title . ' - Kanggui RCM')
@section('meta_description', Str::limit($job->description, 160))

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center space-x-2 text-sm mb-4">
                <a href="{{ route('home') }}" class="text-blue-100 hover:text-white">Home</a>
                <span class="text-blue-200">/</span>
                <a href="{{ route('careers') }}" class="text-blue-100 hover:text-white">Careers</a>
                <span class="text-blue-200">/</span>
                <span class="text-white">{{ $job->title }}</span>
            </nav>
            <h1 class="text-4xl font-bold mb-4">{{ $job->title }}</h1>
            <div class="flex flex-wrap gap-4 text-blue-100">
                @if($job->location)
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ $job->location }}
                    </span>
                @endif
                @if($job->type)
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ ucfirst($job->type) }}
                    </span>
                @endif
                @if($job->department)
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        {{ $job->department }}
                    </span>
                @endif
            </div>
        </div>
    </section>

    <!-- Job Content -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    @if($job->salary_min && $job->salary_max)
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-8">
                            <p class="text-green-800 font-medium">
                                Salary Range: ${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }} {{ $job->currency }}/year
                            </p>
                        </div>
                    @endif

                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Job Description</h2>
                        <div class="prose prose-blue max-w-none">
                            {!! nl2br(e($job->description)) !!}
                        </div>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Requirements</h2>
                        <div class="prose prose-blue max-w-none">
                            {!! nl2br(e($job->requirements)) !!}
                        </div>
                    </div>

                    <!-- Application Form -->
                    <div class="bg-gray-50 rounded-lg p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Apply for This Position</h2>
                        
                        @if(session('success'))
                            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('careers.apply', $job->slug) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name') }}"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                                >
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    value="{{ old('email') }}"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                                >
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input 
                                    type="tel" 
                                    id="phone" 
                                    name="phone" 
                                    value="{{ old('phone') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('phone') border-red-500 @enderror"
                                >
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="resume" class="block text-sm font-medium text-gray-700 mb-2">Resume (PDF, DOC, DOCX) *</label>
                                <input 
                                    type="file" 
                                    id="resume" 
                                    name="resume" 
                                    accept=".pdf,.doc,.docx"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('resume') border-red-500 @enderror"
                                >
                                @error('resume')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Maximum file size: 5MB</p>
                            </div>

                            <div>
                                <label for="cover_letter" class="block text-sm font-medium text-gray-700 mb-2">Cover Letter (Optional)</label>
                                <input 
                                    type="file" 
                                    id="cover_letter" 
                                    name="cover_letter" 
                                    accept=".pdf,.doc,.docx"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('cover_letter') border-red-500 @enderror"
                                >
                                @error('cover_letter')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message (Optional)</label>
                                <textarea 
                                    id="message" 
                                    name="message" 
                                    rows="4"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('message') border-red-500 @enderror"
                                >{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <button 
                                type="submit" 
                                class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                            >
                                Submit Application
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-50 rounded-lg p-6 sticky top-4">
                        <h3 class="text-lg font-semibold mb-4">Job Overview</h3>
                        <ul class="space-y-3 text-sm">
                            @if($job->type)
                                <li class="flex items-start">
                                    <span class="font-medium text-gray-700 mr-2">Job Type:</span>
                                    <span class="text-gray-600">{{ ucfirst($job->type) }}</span>
                                </li>
                            @endif
                            @if($job->location)
                                <li class="flex items-start">
                                    <span class="font-medium text-gray-700 mr-2">Location:</span>
                                    <span class="text-gray-600">{{ $job->location }}</span>
                                </li>
                            @endif
                            @if($job->department)
                                <li class="flex items-start">
                                    <span class="font-medium text-gray-700 mr-2">Department:</span>
                                    <span class="text-gray-600">{{ $job->department }}</span>
                                </li>
                            @endif
                            @if($job->expires_at)
                                <li class="flex items-start">
                                    <span class="font-medium text-gray-700 mr-2">Expires:</span>
                                    <span class="text-gray-600">{{ $job->expires_at->format('F d, Y') }}</span>
                                </li>
                            @endif
                        </ul>

                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h3 class="text-lg font-semibold mb-4">Related Positions</h3>
                            <div class="space-y-3">
                                @forelse($relatedJobs as $related)
                                    <a href="{{ route('careers.show', $related->slug) }}" class="block group">
                                        <h4 class="text-sm font-medium text-gray-900 group-hover:text-blue-600">{{ $related->title }}</h4>
                                        @if($related->location)
                                            <span class="text-xs text-gray-500">{{ $related->location }}</span>
                                        @endif
                                    </a>
                                @empty
                                    <p class="text-gray-500 text-sm">No related positions available.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
