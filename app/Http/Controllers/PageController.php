<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Models\Project;
use App\Models\User;

class PageController extends Controller
{
    /**
     * Display the home page with public images.
     */
    public function home()
    {
        // Get the first user (portfolio owner) - PUBLIC DATA
        $portfolioOwner = User::first();
        
        // Get featured projects
        $projects = Project::active()
            ->featured()
            ->ordered()
            ->take(6)
            ->get();

        return view('pages.home', [
            'projects' => $projects,
            'portfolioOwner' => $portfolioOwner,  // Public portfolio data
            'user' => Auth::user(),  // Authenticated user (if logged in)
        ]);
    }

    public function about()
    {
        return view('pages.about', [
            'user' => Auth::user(),
        ]);
    }

    public function contact()
    {
        return view('pages.contact', [
            'user' => Auth::user(),
        ]);
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string|max:2000',
        ]);

        Mail::to(config('mail.from.address'))
            ->send(new ContactMail($validated));

        return back()->with('success', 'Your message has been sent successfully!');
    }
}