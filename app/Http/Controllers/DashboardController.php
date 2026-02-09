<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $stats = [
            'projects' => Project::count(),
            'published_projects' => Project::where('is_published', true)->count(),
            'featured_projects' => Project::where('is_featured', true)->count(),
            'cv_count' => User::whereNotNull('cv_path')->count(),
        ];

        $recentProjects = Project::latest()->take(5)->get();
        
        return view('admin.dashboard', compact('stats', 'recentProjects'));
    }
}