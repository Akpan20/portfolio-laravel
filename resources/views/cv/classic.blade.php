<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Professional CV of {{ config('portfolio.name', 'Your Name') }} - {{ config('portfolio.title', 'Full Stack Developer') }}">
    <meta name="keywords" content="CV, Resume, Portfolio, Developer, Web Development">
    <meta name="author" content="{{ config('portfolio.name', 'Your Name') }}">
    <meta name="robots" content="index, follow">
    
    <title>Curriculum Vitae - {{ config('portfolio.name', 'Your Name') }}</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>📄</text></svg>">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Source+Code+Pro:wght@300;400&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary-color: #7c3aed;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --text-lighter: #9ca3af;
            --bg-light: #f8fafc;
            --bg-white: #ffffff;
            --border-color: #e5e7eb;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --spacing-xs: 0.5rem;
            --spacing-sm: 1rem;
            --spacing-md: 1.5rem;
            --spacing-lg: 2rem;
            --spacing-xl: 3rem;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background: var(--bg-light);
            padding: var(--spacing-md);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .container {
            max-width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            background: var(--bg-white);
            box-shadow: var(--shadow-lg);
            border-radius: var(--radius-lg);
            overflow: hidden;
        }

        /* Header Styles */
        .header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: var(--spacing-xl) var(--spacing-lg);
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .header-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
        }

        .name {
            font-size: 2.75rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
        }

        .title {
            font-size: 1.25rem;
            font-weight: 400;
            opacity: 0.95;
            margin-bottom: var(--spacing-lg);
            max-width: 600px;
        }

        .contact-info {
            display: flex;
            flex-wrap: wrap;
            gap: var(--spacing-md);
            font-size: 0.875rem;
            font-weight: 500;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.15);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            backdrop-filter: blur(10px);
            transition: all 0.2s ease;
        }

        .contact-item:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-1px);
        }

        .contact-item a {
            color: white;
            text-decoration: none;
        }

        .contact-item a:hover {
            text-decoration: underline;
        }

        /* Main Content */
        .main-content {
            display: grid;
            grid-template-columns: 1fr;
            gap: var(--spacing-lg);
            padding: var(--spacing-xl) var(--spacing-lg);
        }

        @media (min-width: 992px) {
            .main-content {
                grid-template-columns: 2fr 1fr;
            }
            
            .left-column {
                grid-column: 1;
            }
            
            .right-column {
                grid-column: 2;
            }
        }

        /* Section Styles */
        .section {
            margin-bottom: var(--spacing-xl);
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: var(--spacing-md);
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--primary-color);
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 60px;
            height: 2px;
            background: var(--secondary-color);
        }

        /* Summary */
        .summary {
            font-size: 1rem;
            line-height: 1.8;
            color: var(--text-dark);
            background: var(--bg-light);
            padding: var(--spacing-md);
            border-radius: var(--radius-md);
            border-left: 4px solid var(--primary-color);
        }

        /* Experience */
        .timeline {
            position: relative;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 1rem;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--border-color);
        }

        .experience-item {
            position: relative;
            padding-left: 2.5rem;
            margin-bottom: var(--spacing-lg);
        }

        .experience-item:last-child {
            margin-bottom: 0;
        }

        .experience-marker {
            position: absolute;
            left: 0.5rem;
            top: 0.25rem;
            width: 1.5rem;
            height: 1.5rem;
            background: var(--primary-color);
            border: 3px solid var(--bg-white);
            border-radius: 50%;
            box-shadow: var(--shadow-sm);
        }

        .experience-header {
            margin-bottom: 0.5rem;
        }

        .job-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .company {
            font-size: 1rem;
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .duration {
            font-size: 0.875rem;
            color: var(--text-light);
            font-family: 'Source Code Pro', monospace;
            background: var(--bg-light);
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            display: inline-block;
            margin-top: 0.5rem;
        }

        .experience-description {
            color: var(--text-dark);
            line-height: 1.7;
            margin-top: 0.75rem;
        }

        .experience-description ul {
            list-style: none;
            padding-left: 0;
        }

        .experience-description li {
            position: relative;
            padding-left: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .experience-description li::before {
            content: '▸';
            position: absolute;
            left: 0;
            color: var(--primary-color);
            font-weight: bold;
        }

        /* Skills */
        .skills-grid {
            display: grid;
            gap: var(--spacing-sm);
        }

        .skill-category {
            background: var(--bg-light);
            padding: var(--spacing-md);
            border-radius: var(--radius-md);
            transition: transform 0.2s ease;
        }

        .skill-category:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .skill-category h3 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .skill-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .skill-tag {
            background: var(--bg-white);
            color: var(--text-dark);
            padding: 0.375rem 0.75rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 500;
            border: 1px solid var(--border-color);
            transition: all 0.2s ease;
        }

        .skill-tag:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        /* Projects */
        .projects-grid {
            display: grid;
            gap: var(--spacing-md);
        }

        .project-card {
            background: var(--bg-light);
            padding: var(--spacing-md);
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
            transition: all 0.2s ease;
        }

        .project-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-color);
        }

        .project-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .project-tech {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 0.75rem;
        }

        .tech-tag {
            background: var(--bg-white);
            color: var(--text-light);
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-family: 'Source Code Pro', monospace;
            border: 1px solid var(--border-color);
        }

        .project-description {
            color: var(--text-dark);
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .project-links {
            display: flex;
            gap: var(--spacing-sm);
        }

        .project-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
            border-radius: var(--radius-sm);
            transition: all 0.2s ease;
        }

        .project-link:hover {
            background: rgba(37, 99, 235, 0.1);
            transform: translateX(2px);
        }

        /* Education */
        .education-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: var(--spacing-md);
            background: var(--bg-light);
            border-radius: var(--radius-md);
            margin-bottom: var(--spacing-sm);
            transition: transform 0.2s ease;
        }

        .education-item:hover {
            transform: translateX(4px);
        }

        .education-item:last-child {
            margin-bottom: 0;
        }

        .education-content {
            flex: 1;
        }

        .degree {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .institution {
            font-size: 1rem;
            color: var(--text-light);
            margin-bottom: 0.5rem;
        }

        .education-details {
            font-size: 0.875rem;
            color: var(--text-lighter);
        }

        .education-year {
            font-size: 0.875rem;
            color: var(--primary-color);
            font-weight: 600;
            background: var(--bg-white);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            white-space: nowrap;
        }

        /* Certifications */
        .cert-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: var(--spacing-sm) 0;
            border-bottom: 1px solid var(--border-color);
            transition: transform 0.2s ease;
        }

        .cert-item:hover {
            transform: translateX(4px);
        }

        .cert-item:last-child {
            border-bottom: none;
        }

        .cert-content {
            flex: 1;
        }

        .cert-name {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 1rem;
        }

        .cert-issuer {
            color: var(--text-light);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .cert-date {
            color: var(--text-lighter);
            font-size: 0.875rem;
            font-weight: 500;
            background: var(--bg-light);
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
        }

        /* Languages */
        .language-grid {
            display: grid;
            gap: var(--spacing-sm);
        }

        .language-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: var(--spacing-sm);
            background: var(--bg-light);
            border-radius: var(--radius-md);
            transition: transform 0.2s ease;
        }

        .language-item:hover {
            transform: translateX(4px);
        }

        .language-name {
            font-weight: 600;
            color: var(--text-dark);
        }

        .language-level {
            color: var(--text-light);
            font-size: 0.875rem;
            background: var(--bg-white);
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: var(--spacing-lg);
            color: var(--text-light);
            font-size: 0.875rem;
            border-top: 1px solid var(--border-color);
            margin-top: var(--spacing-xl);
        }

        /* Print Styles */
        @media print {
            body {
                background: white;
                padding: 0;
                font-size: 12px;
            }

            .container {
                max-width: 100%;
                box-shadow: none;
                border-radius: 0;
                min-height: auto;
            }

            .header {
                padding: 2rem;
                background: #1f2937 !important;
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            .contact-item {
                background: rgba(255, 255, 255, 0.1) !important;
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            .section {
                page-break-inside: avoid;
            }

            .project-card,
            .experience-item,
            .education-item {
                page-break-inside: avoid;
            }

            .project-link {
                color: #1f2937;
                text-decoration: underline;
            }

            a {
                color: #1f2937 !important;
                text-decoration: underline;
            }

            .main-content {
                padding: 2rem;
            }
            
            .print-button {
                display: none !important;
            }
        }

        @page {
            margin: 0.5in;
            size: A4;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 0.5rem;
            }

            .header {
                padding: var(--spacing-lg) var(--spacing-md);
            }

            .name {
                font-size: 2rem;
            }

            .title {
                font-size: 1rem;
            }

            .contact-info {
                gap: var(--spacing-sm);
            }

            .contact-item {
                font-size: 0.75rem;
                padding: 0.375rem 0.75rem;
            }

            .main-content {
                padding: var(--spacing-lg) var(--spacing-md);
                gap: var(--spacing-md);
            }

            .education-item {
                flex-direction: column;
                gap: var(--spacing-sm);
            }

            .education-year {
                align-self: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <header class="header">
            <div class="header-content">
                <h1 class="name">{{ config('portfolio.name', 'Johnathan Smith') }}</h1>
                <p class="title">{{ config('portfolio.title', 'Senior Full Stack Developer & Tech Lead') }}</p>
                <div class="contact-info">
                    <div class="contact-item">
                        <span>📧</span>
                        <a href="mailto:{{ config('portfolio.email', 'john@example.com') }}">{{ config('portfolio.email', 'john@example.com') }}</a>
                    </div>
                    <div class="contact-item">
                        <span>📱</span>
                        <span>{{ config('portfolio.phone', '+1 (555) 123-4567') }}</span>
                    </div>
                    @if(config('portfolio.website'))
                    <div class="contact-item">
                        <span>🌐</span>
                        <a href="{{ config('portfolio.website') }}" target="_blank">{{ str_replace(['https://', 'http://'], '', config('portfolio.website')) }}</a>
                    </div>
                    @endif
                    @if(config('portfolio.github'))
                    <div class="contact-item">
                        <span>💻</span>
                        <a href="{{ config('portfolio.github') }}" target="_blank">GitHub</a>
                    </div>
                    @endif
                    @if(config('portfolio.linkedin'))
                    <div class="contact-item">
                        <span>💼</span>
                        <a href="{{ config('portfolio.linkedin') }}" target="_blank">LinkedIn</a>
                    </div>
                    @endif
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Left Column -->
            <div class="left-column">
                <!-- Professional Summary -->
                @if(config('portfolio.bio'))
                <section class="section">
                    <h2 class="section-title">Professional Summary</h2>
                    <div class="summary">
                        {{ config('portfolio.bio') }}
                    </div>
                </section>
                @endif

                <!-- Experience -->
                @if(config('portfolio.experience'))
                <section class="section">
                    <h2 class="section-title">Professional Experience</h2>
                    <div class="timeline">
                        @foreach(config('portfolio.experience', []) as $experience)
                        <article class="experience-item">
                            <div class="experience-marker"></div>
                            <div class="experience-header">
                                <h3 class="job-title">{{ $experience['title'] ?? '' }}</h3>
                                <p class="company">{{ $experience['company'] ?? '' }}</p>
                                <span class="duration">{{ $experience['duration'] ?? '' }}</span>
                            </div>
                            <div class="experience-description">
                                {!! $experience['description'] ?? '' !!}
                            </div>
                        </article>
                        @endforeach
                    </div>
                </section>
                @endif

                <!-- Projects -->
                @if(isset($projects) && $projects->count() > 0)
                <section class="section">
                    <h2 class="section-title">Featured Projects</h2>
                    <div class="projects-grid">
                        @foreach($projects as $project)
                        <article class="project-card">
                            <h3 class="project-title">{{ $project->title }}</h3>
                            <div class="project-tech">
                                @if($project->technologies)
                                    @foreach(is_array($project->technologies) ? $project->technologies : json_decode($project->technologies, true) as $tech)
                                    <span class="tech-tag">{{ $tech }}</span>
                                    @endforeach
                                @endif
                            </div>
                            <p class="project-description">
                                {{ $project->description }}
                            </p>
                            <div class="project-links">
                                @if($project->demo_url)
                                <a href="{{ $project->demo_url }}" class="project-link" target="_blank">
                                    <span>🌐</span> Live Demo
                                </a>
                                @endif
                                @if($project->github_url)
                                <a href="{{ $project->github_url }}" class="project-link" target="_blank">
                                    <span>📂</span> Source Code
                                </a>
                                @endif
                            </div>
                        </article>
                        @endforeach
                    </div>
                </section>
                @endif
            </div>

            <!-- Right Column -->
            <div class="right-column">
                <!-- Skills -->
                @if(config('portfolio.skills'))
                <section class="section">
                    <h2 class="section-title">Technical Skills</h2>
                    <div class="skills-grid">
                        @foreach(config('portfolio.skills', []) as $category => $skills)
                        <div class="skill-category">
                            <h3>{{ $category }}</h3>
                            <div class="skill-list">
                                @foreach($skills as $skill)
                                <span class="skill-tag">{{ $skill }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif

                <!-- Education -->
                @if(config('portfolio.education'))
                <section class="section">
                    <h2 class="section-title">Education</h2>
                    @foreach(config('portfolio.education', []) as $edu)
                    <div class="education-item">
                        <div class="education-content">
                            <h3 class="degree">{{ $edu['degree'] ?? '' }}</h3>
                            <p class="institution">{{ $edu['institution'] ?? '' }}</p>
                            @if(isset($edu['details']))
                            <p class="education-details">{{ $edu['details'] }}</p>
                            @endif
                        </div>
                        <div class="education-year">{{ $edu['year'] ?? '' }}</div>
                    </div>
                    @endforeach
                </section>
                @endif

                <!-- Certifications -->
                @if(config('portfolio.certifications'))
                <section class="section">
                    <h2 class="section-title">Certifications</h2>
                    @foreach(config('portfolio.certifications', []) as $cert)
                    <div class="cert-item">
                        <div class="cert-content">
                            <h3 class="cert-name">{{ $cert['name'] ?? '' }}</h3>
                            <p class="cert-issuer">{{ $cert['issuer'] ?? '' }}</p>
                        </div>
                        <div class="cert-date">{{ $cert['date'] ?? '' }}</div>
                    </div>
                    @endforeach
                </section>
                @endif

                <!-- Languages -->
                @if(config('portfolio.languages'))
                <section class="section">
                    <h2 class="section-title">Languages</h2>
                    <div class="language-grid">
                        @foreach(config('portfolio.languages', []) as $language => $level)
                        <div class="language-item">
                            <span class="language-name">{{ $language }}</span>
                            <span class="language-level">{{ $level }}</span>
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <p>Updated: {{ date('F Y') }} | References available upon request</p>
        </footer>
    </div>

    <script>
        // Add subtle animations on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Animate sections on scroll
            document.querySelectorAll('.section, .project-card, .experience-item').forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = `opacity 0.5s ease ${index * 0.1}s, transform 0.5s ease ${index * 0.1}s`;
                observer.observe(el);
            });

            // Print functionality
            document.addEventListener('keydown', (e) => {
                if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
                    e.preventDefault();
                    window.print();
                }
            });

            // Add "Print CV" button for convenience
            const printButton = document.createElement('button');
            printButton.innerHTML = '🖨️ Print CV';
            printButton.className = 'print-button';
            printButton.style.position = 'fixed';
            printButton.style.bottom = '20px';
            printButton.style.right = '20px';
            printButton.style.padding = '10px 20px';
            printButton.style.background = 'var(--primary-color)';
            printButton.style.color = 'white';
            printButton.style.border = 'none';
            printButton.style.borderRadius = '50px';
            printButton.style.cursor = 'pointer';
            printButton.style.boxShadow = 'var(--shadow-md)';
            printButton.style.zIndex = '1000';
            printButton.style.fontFamily = 'inherit';
            printButton.style.fontSize = '0.875rem';
            printButton.style.fontWeight = '600';
            printButton.style.transition = 'all 0.2s ease';
            
            printButton.addEventListener('mouseenter', () => {
                printButton.style.transform = 'translateY(-2px)';
                printButton.style.boxShadow = 'var(--shadow-lg)';
            });
            
            printButton.addEventListener('mouseleave', () => {
                printButton.style.transform = 'translateY(0)';
                printButton.style.boxShadow = 'var(--shadow-md)';
            });
            
            printButton.addEventListener('click', () => window.print());
            document.body.appendChild(printButton);
        });
    </script>
</body>
</html>