@extends('layouts.app')

@section('title', 'Home')

@php
    // Tech stack array
    $techStack = [
        ['name' => 'PHP / Laravel', 'icon' => 'M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222'],
        ['name' => 'Python (Django, FastAPI)', 'icon' => 'M10.75 16.82A7.462 7.462 0 0115 15.5c.71 0 1.396.098 2.046.282A5.5 5.5 0 0021.5 10.5c0-.425-.048-.839-.139-1.236A9.009 9.009 0 0119.5 9c-1.665 0-3.204.444-4.544 1.22A7.466 7.466 0 0010.75 9.18a5.499 5.499 0 00-9.611 0A7.466 7.466 0 006.044 10.22 9.011 9.011 0 011.5 9c-.74 0-1.46.103-2.139.264A5.492 5.492 0 00-.139 10.5c0 .425.048.839.139 1.236A9.009 9.009 0 011.5 12c1.665 0 3.204-.444 4.544-1.22'],
        ['name' => 'Node.js', 'icon' => 'M5 12h14M12 5l7 7-7 7'],
        ['name' => 'RESTful APIs', 'icon' => 'M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
        ['name' => 'SQL & SQLite', 'icon' => 'M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4'],
        ['name' => 'Clean Architecture', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10']
    ];
@endphp

@section('content')

<!-- Hero Section -->
<section class="relative min-h-screen flex items-center overflow-hidden">
    <!-- Dynamic Background - PUBLIC (uses portfolioOwner, not auth) -->
    @if($portfolioOwner && $portfolioOwner->hasCoverImage())
        <div class="absolute inset-0">
            <img 
                src="{{ $portfolioOwner->cover_image_url }}" 
                alt="Cover Image"
                class="w-full h-full object-cover brightness-75"
                loading="lazy"
            >
            <div class="absolute inset-0 bg-gradient-to-br from-gray-900/70 via-indigo-900/60 to-purple-900/70"></div>
        </div>
    @else
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50"></div>
    @endif

    <!-- Decorative blobs -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute -top-20 -right-20 w-96 h-96 bg-blue-400/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-96 h-96 bg-purple-400/20 rounded-full blur-3xl"></div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 py-24 md:py-32">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <!-- Left: Text + CTA -->
            <div class="text-center lg:text-left">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full mb-8 backdrop-blur-md border border-white/20 bg-white/10 text-white text-sm font-medium">
                    <span class="w-2.5 h-2.5 bg-green-400 rounded-full animate-pulse"></span>
                    Available for new projects
                </div>

                <!-- Heading -->
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight mb-6">
                    Hi, I'm <span class="bg-gradient-to-r from-blue-400 via-indigo-400 to-purple-400 bg-clip-text text-transparent">Akan</span>
                </h1>

                <h2 class="text-3xl sm:text-4xl font-bold mb-8 text-gray-800 dark:text-gray-200">
                    Full-Stack Web Developer
                </h2>

                <!-- Description -->
                <p class="text-xl leading-relaxed mb-10 text-gray-700 dark:text-gray-300 max-w-3xl mx-auto lg:mx-0">
                    I build scalable, secure, and maintainable web applications using 
                    <span class="font-semibold text-indigo-600 dark:text-indigo-400">Laravel</span>, 
                    <span class="font-semibold text-blue-600 dark:text-blue-400">PHP</span>, 
                    <span class="font-semibold text-yellow-600 dark:text-yellow-400">Python</span>, and 
                    <span class="font-semibold text-green-600 dark:text-green-400">Node.js</span>.
                    With 5+ years of experience, I focus on clean architecture and long-term reliability.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-wrap justify-center lg:justify-start gap-5">
                    <a href="{{ route('about') }}" 
                       class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        About Me
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>

                    <a href="{{ route('contact') }}" 
                       class="inline-flex items-center px-8 py-4 border-2 border-indigo-500/50 hover:border-indigo-500 text-indigo-600 dark:text-indigo-400 font-semibold rounded-xl transition-all duration-300 hover:bg-indigo-500/10">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Get in Touch
                    </a>
                </div>

                <!-- Social Links -->
                <div class="mt-12 flex items-center justify-center lg:justify-start gap-6">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Find me on:</span>
                    <div class="flex gap-4">
                        <a href="https://github.com/Akpan20" target="_blank" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right: Home Image - PUBLIC (different from authenticated avatar) -->
            <div class="flex justify-center lg:justify-end">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/30 to-purple-500/30 rounded-full blur-3xl animate-pulse"></div>
                    @if($portfolioOwner && $portfolioOwner->hasHomeImage())
                        <img
                            src="{{ $portfolioOwner->home_image_url }}"
                            alt="{{ $portfolioOwner->name ?? 'Developer' }}"
                            class="relative w-64 h-64 sm:w-80 sm:h-80 lg:w-96 lg:h-96 rounded-full object-cover shadow-2xl ring-8 ring-white/20 dark:ring-gray-900/50"
                            loading="lazy"
                        >
                    @else
                        <img
                            src="{{ asset('assets/profile.png') }}"
                            alt="Akan - Full-Stack Developer"
                            class="relative w-64 h-64 sm:w-80 sm:h-80 lg:w-96 lg:h-96 rounded-full object-cover shadow-2xl ring-8 ring-white/20 dark:ring-gray-900/50"
                            loading="lazy"
                            onerror="this.src='https://ui-avatars.com/api/?name=Akan&background=4F46E5&color=fff&size=512';"
                        >
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tech Stack Section -->
<section class="relative py-24 bg-white/50 dark:bg-gray-900/30 backdrop-blur-sm">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                Core Technologies
            </h2>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">
                Tools & frameworks I use daily to build modern applications
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($techStack as $tech)
                <div class="group bg-white dark:bg-gray-800/80 rounded-2xl p-8 shadow-lg hover:shadow-2xl border border-gray-100 dark:border-gray-700 hover:border-indigo-500 transition-all duration-300 transform hover:-translate-y-2">
                    <div class="flex items-start gap-5">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $tech['icon'] }}"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                {{ $tech['name'] }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                Professional experience & deep expertise
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Projects Section -->
<section class="relative py-24 bg-gradient-to-br from-gray-50 to-blue-50 dark:from-gray-900 dark:to-gray-800">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">
                Featured <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Projects</span>
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                Recent work from my GitHub portfolio showcasing modern web development
            </p>
        </div>

        @if(isset($projects) && (is_array($projects) ? count($projects) : $projects->count()) > 0)
        <!-- Projects Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach($projects as $index => $project)
                @if($index < 6)
                    <article class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-2">
                        <!-- Project Header -->
                        <div class="relative bg-gradient-to-br from-blue-500 to-indigo-600 p-6 h-32">
                            <h3 class="text-xl font-bold text-white mb-2 line-clamp-2">
                                {{ is_array($project) ? ucwords(str_replace(['-', '_'], ' ', $project['title'])) : ucwords(str_replace(['-', '_'], ' ', $project->title)) }}
                            </h3>
                            
                            @php
                                $isFeatured = is_array($project) ? ($project['is_featured'] ?? false) : ($project->is_featured ?? false);
                            @endphp
                            
                            @if($isFeatured)
                                <div class="absolute top-4 right-4">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-yellow-400 text-yellow-900">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        ⭐
                                    </span>
                                </div>
                            @endif

                            @php
                                $stars = is_array($project) ? ($project['stars'] ?? 0) : ($project->stars ?? 0);
                                $forks = is_array($project) ? ($project['forks'] ?? 0) : ($project->forks ?? 0);
                            @endphp

                            <!-- GitHub Stats -->
                            <div class="flex gap-4 text-white/90 text-sm mt-2">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    {{ $stars }}
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.707 3.293a1 1 0 010 1.414L5.414 7H11a7 7 0 017 7v2a1 1 0 11-2 0v-2a5 5 0 00-5-5H5.414l2.293 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $forks }}
                                </div>
                            </div>
                        </div>

                        <!-- Project Content -->
                        <div class="p-6">
                            @php
                                $description = is_array($project) ? ($project['description'] ?? 'No description available.') : ($project->description ?? 'No description available.');
                            @endphp
                            
                            <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-3 min-h-[4.5rem]">
                                {{ $description }}
                            </p>

                            <!-- Technologies -->
                            @php
                                $technologies = is_array($project) ? ($project['technologies'] ?? []) : ($project->technologies ?? []);
                                $topics = is_array($project) ? ($project['topics'] ?? []) : ($project->topics ?? []);
                                $allTechs = array_merge((array)$technologies, (array)$topics);
                            @endphp
                            
                            @if(!empty($allTechs))
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach(array_slice($allTechs, 0, 3) as $tech)
                                        <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 text-xs font-medium rounded-full">
                                            {{ $tech }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Action Button -->
                            @php
                                $githubUrl = is_array($project) ? ($project['github_url'] ?? '#') : ($project->github_url ?? '#');
                            @endphp
                            
                            <a href="{{ $githubUrl }}" 
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-semibold group">
                                View on GitHub
                                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                @endif
            @endforeach
        </div>

        <!-- View All Projects Button -->
        <div class="text-center">
            <a href="{{ route('projects.index') }}" 
            class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                View All Projects
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg mb-6">Projects will be displayed here once available.</p>
            <a href="https://github.com/Akpan20" 
            target="_blank"
            class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold">
                Visit my GitHub profile
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
            </a>
        </div>
    @endif
    </div>
</section>

<!-- CTA Section -->
<section class="relative py-24 bg-gradient-to-br from-gray-900 to-indigo-950 overflow-hidden">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-32 -right-32 w-[500px] h-[500px] bg-purple-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-32 -left-32 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-3xl"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 text-center">
        <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
            Ready to Build Something Great?
        </h2>
        <p class="text-xl text-gray-300 mb-12 max-w-3xl mx-auto">
            Let's collaborate on your next project. Clean code, modern architecture, and long-term maintainability guaranteed.
        </p>

        <div class="flex flex-col sm:flex-row gap-6 justify-center">
            <a href="{{ route('contact') }}" 
               class="inline-flex items-center px-10 py-5 bg-white text-indigo-950 font-bold rounded-xl shadow-2xl hover:shadow-xl hover:bg-gray-100 transition-all text-lg">
                Get in Touch
                <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>

            <a href="{{ route('about') }}" 
               class="inline-flex items-center px-10 py-5 border-2 border-white/40 text-white font-bold rounded-xl hover:bg-white/10 transition-all text-lg">
                Learn More About Me
            </a>
        </div>
    </div>
</section>

@endsection