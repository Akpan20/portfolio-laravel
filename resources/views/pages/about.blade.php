@extends('layouts.app')

@section('title', 'About')

@section('content')
<section class="relative py-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-blue-50 via-white to-indigo-50 overflow-hidden">
    <!-- Background Decorative Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-blue-400/20 to-indigo-400/20 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 -left-40 w-80 h-80 bg-gradient-to-tr from-purple-400/20 to-pink-400/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 right-1/4 w-80 h-80 bg-gradient-to-tl from-blue-400/20 to-cyan-400/20 rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-4xl mx-auto relative z-10">
        <!-- Header with Gradient Text -->
        <h1 class="text-4xl sm:text-5xl font-bold bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 bg-clip-text text-transparent mb-8">
            About Me
        </h1>

        <div class="prose prose-lg max-w-none">
            <!-- Intro Paragraphs with Subtle Card -->
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-8 shadow-sm border border-gray-100 mb-8">
                <p class="text-xl text-gray-700 leading-relaxed mb-6">
                    I am a web developer with over <strong class="font-semibold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">five years of experience</strong>
                    designing and building backend-heavy web applications.
                    My work emphasizes correctness, clarity, and long-term maintainability.
                </p>

                <p class="text-xl text-gray-700 leading-relaxed">
                    I specialize in Laravel-based systems, API design, and data-driven
                    applications. I am particularly interested in clean domain modeling,
                    modular architecture, and systems that remain understandable
                    years after deployment.
                </p>
            </div>

            <!-- Professional Focus Section -->
            <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl p-8 shadow-lg mb-8">
                <h2 class="text-3xl font-bold text-white mb-6">
                    Professional Focus
                </h2>
                
                <ul class="space-y-4">
                    <li class="flex items-start group">
                        <div class="w-8 h-8 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center mr-4 mt-0.5 flex-shrink-0 group-hover:bg-white/30 transition-colors">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-lg text-white/95 leading-relaxed">Backend architecture & domain modeling</span>
                    </li>
                    <li class="flex items-start group">
                        <div class="w-8 h-8 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center mr-4 mt-0.5 flex-shrink-0 group-hover:bg-white/30 transition-colors">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-lg text-white/95 leading-relaxed">Secure authentication and authorization</span>
                    </li>
                    <li class="flex items-start group">
                        <div class="w-8 h-8 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center mr-4 mt-0.5 flex-shrink-0 group-hover:bg-white/30 transition-colors">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-lg text-white/95 leading-relaxed">Relational database design</span>
                    </li>
                    <li class="flex items-start group">
                        <div class="w-8 h-8 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center mr-4 mt-0.5 flex-shrink-0 group-hover:bg-white/30 transition-colors">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-lg text-white/95 leading-relaxed">Developer-friendly APIs</span>
                    </li>
                </ul>
            </div>

            <!-- Outside of Code Section -->
            <div class="bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl p-8 shadow-lg">
                <h2 class="text-3xl font-bold text-white mb-6">
                    Outside of Code
                </h2>
                
                <p class="text-xl text-white/95 leading-relaxed">
                    Beyond development, I value technical writing, mentoring,
                    and disciplined engineering practices.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection