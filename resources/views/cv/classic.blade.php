<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $user->name ?? 'Curriculum Vitae' }}</title>
    <style>
        body {
            font-family: Georgia, "Times New Roman", serif;
            color: #222;
            line-height: 1.5;
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
        }
        header {
            border-bottom: 2px solid #000;
            margin-bottom: 24px;
            padding-bottom: 12px;
        }
        h1 {
            margin: 0;
            font-size: 32px;
        }
        .subtitle {
            font-size: 16px;
            color: #555;
        }
        section {
            margin-bottom: 28px;
        }
        h2 {
            font-size: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 4px;
            margin-bottom: 12px;
        }
        .project {
            margin-bottom: 16px;
        }
        .project-title {
            font-weight: bold;
        }
        .tags {
            font-size: 13px;
            color: #666;
        }
    </style>
</head>
<body>
<div class="container">

    <header>
        <h1>{{ $user->name ?? 'Your Name' }}</h1>
        <div class="subtitle">
            {{ $user->title ?? 'Full-Stack Web Developer' }} —
            {{ $user->email ?? 'email@example.com' }}
        </div>
    </header>

    <section>
        <h2>Profile</h2>
        <p>
            {{ $user->summary ?? 'Experienced web developer with a focus on backend systems, clean architecture, and long-term maintainability.' }}
        </p>
    </section>

    <section>
        <h2>Core Skills</h2>
        <ul>
            <li>PHP / Laravel</li>
            <li>Python (Django / FastAPI)</li>
            <li>Node.js</li>
            <li>REST APIs & Database Design</li>
        </ul>
    </section>

    <section>
        <h2>Selected Projects</h2>

        @foreach($projects as $project)
            <div class="project">
                <div class="project-title">
                    {{ $project->title }}
                    @if($project->url)
                        — <a href="{{ $project->url }}">{{ $project->url }}</a>
                    @endif
                </div>

                <p>{{ $project->description }}</p>

                @if($project->tags->isNotEmpty())
                    <div class="tags">
                        Technologies:
                        {{ $project->tags->pluck('name')->join(', ') }}
                    </div>
                @endif
            </div>
        @endforeach
    </section>

</div>
</body>
</html>
