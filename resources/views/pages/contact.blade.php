@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<section class="page">
    <div class="container">
        <h1>Contact</h1>

        <p>
            If you’d like to discuss a project, collaboration, or opportunity,
            feel free to reach out using the form below.
        </p>

        <form method="POST" action="{{ route('contact.send') }}" class="contact-form">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" name="name" type="text" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" required>
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Send Message
            </button>
        </form>

        <div class="social-links">
            <h3>Find me online</h3>
            <ul>
                <li><a href="https://github.com/your-handle" target="_blank">GitHub</a></li>
                <li><a href="https://linkedin.com/in/your-handle" target="_blank">LinkedIn</a></li>
                <li><a href="https://twitter.com/your-handle" target="_blank">Twitter</a></li>
            </ul>
        </div>
    </div>
</section>
@endsection
