@extends('layouts.app')

@section('title', 'Home')

@section('content')
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <img src="{{ asset('assets/profile.png') }}" alt="Profile photo" class="profile-image">

            <h1>Hi, I’m Akan</h1>
            <h2>Full-Stack Web Developer</h2>

            <p>
                I build scalable, secure, and maintainable web applications using
                <strong>Laravel, PHP, Python, and Node.js</strong>.
                With over 5 years of professional experience, I focus on clean
                architecture and long-term reliability.
            </p>

            <div class="hero-actions">
                <a href="{{ route('about') }}" class="btn btn-primary">About Me</a>
                <a href="{{ route('contact') }}" class="btn btn-secondary">Contact</a>
            </div>
        </div>
    </div>
</section>

<section class="tech-stack">
    <div class="container">
        <h3>Core Technologies</h3>
        <ul class="stack-list">
            <li>PHP / Laravel</li>
            <li>Python (Django / FastAPI)</li>
            <li>Node.js</li>
            <li>REST APIs</li>
            <li>SQL & SQLite</li>
        </ul>
    </div>
</section>
@endsection
