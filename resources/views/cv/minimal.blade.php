<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV - {{ config('portfolio.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Helvetica Neue', Arial, 'Inter', sans-serif;
            line-height: 1.6;
            color: #1f2937;
            background: white;
        }

        .container {
            max-width: 210mm;
            margin: 0 auto;
            padding: 60px 80px;
        }

        /* Header Section */
        .header {
            margin-bottom: 50px;
            padding-bottom: 30px;
            border-bottom: 2px solid #000;
        }

        .header h1 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -1px;
        }

        .header .subtitle {
            font-size: 18px;
            color: #6b7280;
            margin-bottom: 20px;
        }

        .contact-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            font-size: 14px;
            color: #4b5563;
        }

        .contact-bar a {
            color: #4b5563;
            text-decoration: none;
        }

        .contact-bar a:hover {
            color: #000;
        }

        .contact-bar span {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Two Column Layout */
        .two-column {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 60px;
        }

        /* Section Styling */
        .section {
            margin-bottom: 45px;
        }

        .section-title {
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 20px;
            color: #3b82f6;
        }

        /* About/Summary */
        .about-text {
            font-size: 15px;
            line-height: 1.8;
            color: #374151;
        }

        /* Experience */
        .exp-item {
            margin-bottom: 30px;
        }

        .exp-header {
            margin-bottom: 8px;
        }

        .exp-title {
            font-size: 16px;
            font-weight: 700;
            color: #000;
        }

        .exp-company {
            font-size: 15px;
            color: #4b5563;
            margin-top: 2px;
        }

        .exp-date {
            font-size: 13px;
            color: #9ca3af;
            margin-top: 2px;
        }

        .exp-description {
            font-size: 14px;
            color: #4b5563;
            line-height: 1.7;
            margin-top: 10px;
        }

        .exp-description ul {
            margin-left: 18px;
            margin-top: 8px;
        }

        .exp-description li {
            margin-bottom: 6px;
        }

        /* Projects */
        .project-item {
            margin-bottom: 25px;
        }

        .project-title {
            font-size: 16px;
            font-weight: 700;
            color: #000;
            margin-bottom: 4px;
        }

        .project-meta {
            font-size: 13px;
            color: #9ca3af;
            margin-bottom: 8px;
        }

        .project-description {
            font-size: 14px;
            color: #4b5563;
            line-height: 1.7;
        }

        .project-links {
            margin-top: 8px;
            font-size: 13px;
        }

        .project-links a {
            color: #000;
            text-decoration: underline;
            margin-right: 12px;
        }

        /* Education */
        .edu-item {
            margin-bottom: 20px;
        }

        .edu-degree {
            font-size: 15px;
            font-weight: 700;
            color: #000;
        }

        .edu-school {
            font-size: 14px;
            color: #4b5563;
            margin-top: 2px;
        }

        .edu-date {
            font-size: 13px;
            color: #9ca3af;
            margin-top: 2px;
        }

        /* Skills - Sidebar */
        .skill-group {
            margin-bottom: 25px;
        }

        .skill-group-title {
            font-size: 13px;
            font-weight: 700;
            color: #000;
            margin-bottom: 10px;
        }

        .skill-list {
            list-style: none;
        }

        .skill-list li {
            font-size: 13px;
            color: #4b5563;
            padding: 4px 0;
        }

        /* Simple List Items */
        .simple-list {
            list-style: none;
        }

        .simple-list li {
            font-size: 14px;
            color: #4b5563;
            padding: 6px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .simple-list li:last-child {
            border-bottom: none;
        }

        .list-item-title {
            font-weight: 600;
            color: #000;
        }

        .list-item-sub {
            font-size: 13px;
            color: #9ca3af;
        }

        /* Horizontal Divider */
        .divider {
            height: 1px;
            background: #e5e7eb;
            margin: 25px 0;
        }

        /* Certifications */
        .cert-list li {
            display: flex;
            justify-content: space-between;
            align-items: start;
        }

        /* Languages */
        .lang-item {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            padding: 6px 0;
        }

        .lang-name {
            font-weight: 600;
            color: #000;
        }

        .lang-level {
            color: #9ca3af;
            font-size: 13px;
        }

        /* Print Styles */
        @media print {
            body {
                background: white;
            }

            .container {
                padding: 40px 50px;
                max-width: 100%;
            }

            .section {
                page-break-inside: avoid;
            }

            .exp-item,
            .project-item {
                page-break-inside: avoid;
            }

            a {
                color: #000 !important;
            }
        }

        @page {
            margin: 0;
            size: A4;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 40px 30px;
            }

            .two-column {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .header h1 {
                font-size: 36px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <h1>{{ config('portfolio.name', 'Your Name') }}</h1>
            <div class="subtitle">{{ config('portfolio.title', 'Full Stack Developer') }}</div>
            <div class="contact-bar">
                <span>{{ config('portfolio.email', 'email@example.com') }}</span>
                <span>{{ config('portfolio.phone', '+1234567890') }}</span>
                @if(config('portfolio.website'))
                    <a href="{{ config('portfolio.website') }}" target="_blank">{{ str_replace(['https://', 'http://'], '', config('portfolio.website')) }}</a>
                @endif
                @if(config('portfolio.github'))
                    <a href="{{ config('portfolio.github') }}" target="_blank">GitHub</a>
                @endif
                @if(config('portfolio.linkedin'))
                    <a href="{{ config('portfolio.linkedin') }}" target="_blank">LinkedIn</a>
                @endif
            </div>
        </header>

        <div class="two-column">
            <!-- Main Column -->
            <div class="main-column">
                <!-- About -->
                @if(config('portfolio.bio'))
                <section class="section">
                    <h2 class="section-title">About</h2>
                    <p class="about-text">
                        {{ config('portfolio.bio') }}
                    </p>
                </section>
                @endif

                <!-- Experience -->
                @if(config('portfolio.experience'))
                <section class="section">
                    <h2 class="section-title">Experience</h2>

                    @foreach(config('portfolio.experience', []) as $experience)
                    <div class="exp-item">
                        <div class="exp-header">
                            <div class="exp-title">{{ $experience['title'] ?? '' }}</div>
                            <div class="exp-company">{{ $experience['company'] ?? '' }}</div>
                            <div class="exp-date">{{ $experience['duration'] ?? '' }}</div>
                        </div>
                        <div class="exp-description">
                            {!! $experience['description'] ?? '' !!}
                        </div>
                    </div>
                    @endforeach
                </section>
                @endif

                <!-- Projects -->
                @if(isset($projects) && $projects->count() > 0)
                <section class="section">
                    <h2 class="section-title">Projects</h2>

                    @foreach($projects as $project)
                    <div class="project-item">
                        <div class="project-title">{{ $project->title }}</div>
                        <div class="project-meta">
                            @if($project->technologies)
                                {{ is_array($project->technologies) ? implode(', ', $project->technologies) : implode(', ', json_decode($project->technologies, true)) }}
                            @endif
                        </div>
                        <div class="project-description">{{ $project->description }}</div>
                        <div class="project-links">
                            @if($project->demo_url)
                                <a href="{{ $project->demo_url }}" target="_blank">Live</a>
                            @endif
                            @if($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank">Code</a>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </section>
                @endif

                <!-- Education -->
                @if(config('portfolio.education'))
                <section class="section">
                    <h2 class="section-title">Education</h2>

                    @foreach(config('portfolio.education', []) as $edu)
                    <div class="edu-item">
                        <div class="edu-degree">{{ $edu['degree'] ?? '' }}</div>
                        <div class="edu-school">{{ $edu['institution'] ?? '' }}</div>
                        <div class="edu-date">{{ $edu['year'] ?? '' }}</div>
                    </div>
                    @endforeach
                </section>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Skills -->
                @if(config('portfolio.skills'))
                <section class="section">
                    <h2 class="section-title">Skills</h2>

                    @foreach(config('portfolio.skills', []) as $category => $skills)
                    <div class="skill-group">
                        <div class="skill-group-title">{{ $category }}</div>
                        <ul class="skill-list">
                            @foreach($skills as $skill)
                            <li>{{ $skill }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                </section>
                @endif

                <!-- Certifications -->
                @if(config('portfolio.certifications'))
                <section class="section">
                    <h2 class="section-title">Certifications</h2>
                    <ul class="simple-list cert-list">
                        @foreach(config('portfolio.certifications', []) as $cert)
                        <li>
                            <div>
                                <div class="list-item-title">{{ $cert['name'] ?? '' }}</div>
                                <div class="list-item-sub">{{ $cert['date'] ?? '' }}</div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </section>
                @endif

                <!-- Languages -->
                @if(config('portfolio.languages'))
                <section class="section">
                    <h2 class="section-title">Languages</h2>
                    <div>
                        @foreach(config('portfolio.languages', []) as $language => $level)
                        <div class="lang-item">
                            <span class="lang-name">{{ $language }}</span>
                            <span class="lang-level">{{ $level }}</span>
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif
            </div>
        </div>
    </div>
</body>
</html>