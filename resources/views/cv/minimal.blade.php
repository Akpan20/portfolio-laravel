<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $user->name ?? 'CV' }}</title>
    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
            color: #111;
            margin: 0;
            padding: 0;
        }
        .wrapper {
            max-width: 800px;
            margin: 32px auto;
            padding: 0 16px;
        }
        h1 {
            font-size: 28px;
            margin-bottom: 4px;
        }
        .meta {
            color: #666;
            font-size: 14px;
            margin-bottom: 24px;
        }
        section {
            margin-bottom: 24px;
        }
        h2 {
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #444;
            margin-bottom: 8px;
        }
        .project {
            margin-bottom: 12px;
        }
        .project span {
            color: #666;
            font-size: 13px;
        }
    </style>
</head>
<body>
<div class="wrapper">

    <h1>{{ $user->name ?? 'Your Name' }}</h1>
    <div class="meta">
        {{ $user->title ?? 'Web Developer' }} · {{ $user->email ?? 'email@example.com' }}
    </div>

    <section>
        <h2>Summary</h2>
        <p>
            {{ $user->summary ?? 'Developer with 5+ years experience building robust web applications and APIs.' }}
        </p>
    </section>

    <section>
        <h2>Projects</h2>

        @foreach($projects as $project)
            <div class="project">
                <strong>{{ $project->title }}</strong>
                @if($project->url)
                    <span>— {{ $project->url }}</span>
                @endif
                <div>{{ $project->description }}</div>
            </div>
        @endforeach
    </section>

    <section>
        <h2>Technologies</h2>
        <p>Laravel · PHP · Python · Node.js · SQL</p>
    </section>

</div>
</body>
</html>
