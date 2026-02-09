<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ProjectController extends Controller
{
    /**
     * Display a listing of projects fetched from GitHub
     */
    public function index(): View
    {
        $projects = $this->fetchGitHubRepositories();
        
        return view('projects.index', compact('projects'));
    }

    /**
     * Display the specified project
     */
    public function show(string $project): View
    {
        $projectData = $this->fetchGitHubRepository($project);
        
        if (!$projectData) {
            abort(404);
        }
        
        return view('projects.show', compact('projectData'));
    }

    /**
     * Fetch repositories from GitHub API
     */
    private function fetchGitHubRepositories(): array
    {
        // Cache for 1 hour to avoid hitting rate limits
        return Cache::remember('github_repos', 3600, function () {
            $username = config('portfolio.github_username', env('GITHUB_USERNAME', 'Akpan20'));
            
            try {
                $response = Http::get("https://api.github.com/users/{$username}/repos", [
                    'sort' => 'updated',
                    'per_page' => 100,
                ]);

                if ($response->successful()) {
                    $repos = $response->json();
                    
                    // Filter and transform repositories
                    return collect($repos)
                        ->filter(function ($repo) {
                            // Only show non-forked repos (or customize this filter)
                            return !$repo['fork'];
                        })
                        ->map(function ($repo) {
                            return [
                                'id' => $repo['id'],
                                'title' => $repo['name'],
                                'description' => $repo['description'] ?? 'No description available',
                                'technologies' => $repo['language'] ? [$repo['language']] : [],
                                'topics' => $repo['topics'] ?? [],
                                'github_url' => $repo['html_url'],
                                'demo_url' => $repo['homepage'] ?? null,
                                'stars' => $repo['stargazers_count'],
                                'forks' => $repo['forks_count'],
                                'is_featured' => $repo['stargazers_count'] > 5, // Customize this
                                'updated_at' => $repo['updated_at'],
                                'created_at' => $repo['created_at'],
                            ];
                        })
                        ->sortByDesc('stars')
                        ->values()
                        ->toArray();
                }
            } catch (\Exception $e) {
                \Log::error('GitHub API Error: ' . $e->getMessage());
            }

            return [];
        });
    }

    /**
     * Fetch a single repository from GitHub API
     */
    private function fetchGitHubRepository(string $repoName): ?array
    {
        $username = config('portfolio.github_username', env('GITHUB_USERNAME', 'your-github-username'));
        
        try {
            $response = Http::get("https://api.github.com/repos/{$username}/{$repoName}");

            if ($response->successful()) {
                $repo = $response->json();
                
                return [
                    'id' => $repo['id'],
                    'title' => $repo['name'],
                    'description' => $repo['description'] ?? 'No description available',
                    'technologies' => $repo['language'] ? [$repo['language']] : [],
                    'topics' => $repo['topics'] ?? [],
                    'github_url' => $repo['html_url'],
                    'demo_url' => $repo['homepage'] ?? null,
                    'stars' => $repo['stargazers_count'],
                    'forks' => $repo['forks_count'],
                    'updated_at' => $repo['updated_at'],
                    'created_at' => $repo['created_at'],
                    'readme' => $this->fetchReadme($username, $repoName),
                ];
            }
        } catch (\Exception $e) {
            \Log::error('GitHub API Error: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Fetch repository README
     */
    private function fetchReadme(string $username, string $repoName): ?string
    {
        try {
            $response = Http::get("https://api.github.com/repos/{$username}/{$repoName}/readme");
            
            if ($response->successful()) {
                $data = $response->json();
                return base64_decode($data['content']);
            }
        } catch (\Exception $e) {
            \Log::error('GitHub README Error: ' . $e->getMessage());
        }

        return null;
    }
}