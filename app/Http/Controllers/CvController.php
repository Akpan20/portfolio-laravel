<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class CvController extends Controller
{
    /**
     * Display CV management page
     */
    public function index(): View
    {
        /** @var User $user */
        $user = Auth::user();
        $cvFiles = $this->getCvFiles();
        
        return view('admin.cv.index', compact('user', 'cvFiles'));
    }

    /**
     * Upload a CV file
     */
    public function upload(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'cv_file' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB max
        ]);

        /** @var User $user */
        $user = Auth::user();
        
        // Store the uploaded file
        $path = $request->file('cv_file')->store('cvs/uploaded', 'public');
        
        // Update user's current CV path using the User model's fillable attribute
        $user->cv_path = $path;
        $user->save();

        return redirect()
            ->route('admin.cv.index')
            ->with('success', 'CV uploaded successfully!');
    }

    /**
     * Generate CV from template
     */
    public function generate(Request $request): RedirectResponse
    {
        $request->validate([
            'template' => 'required|in:classic,minimal',
        ]);

        $template = $request->template;
        
        /** @var User $user */
        $user = Auth::user();
        
        // Get projects for CV
        $projects = Project::featured()->active()->ordered()->take(3)->get();
        
        // Generate PDF
        $pdf = Pdf::loadView("cv.{$template}", compact('projects'));
        $pdf->setPaper('a4', 'portrait');
        
        // Create filename
        $filename = 'cv_' . strtolower(str_replace(' ', '_', $user->name)) . '_' . $template . '_' . time() . '.pdf';
        $path = 'cvs/generated/' . $filename;
        
        // Save PDF to storage
        Storage::disk('public')->put($path, $pdf->output());
        
        // Update user's current CV path
        $user->cv_path = $path;
        $user->save();

        return redirect()
            ->route('admin.cv.index')
            ->with('success', "CV generated successfully using {$template} template!");
    }

    /**
     * Delete a CV file
     */
    public function destroy(string $path): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $decodedPath = urldecode($path);
        
        // Prevent deletion of current CV
        if ($user->cv_path === $decodedPath) {
            return redirect()
                ->route('admin.cv.index')
                ->with('error', 'Cannot delete the current active CV. Please set a different CV as active first.');
        }
        
        // Delete the file
        if (Storage::disk('public')->exists($decodedPath)) {
            Storage::disk('public')->delete($decodedPath);
            
            return redirect()
                ->route('admin.cv.index')
                ->with('success', 'CV deleted successfully!');
        }
        
        return redirect()
            ->route('admin.cv.index')
            ->with('error', 'CV file not found.');
    }

    /**
     * Get all CV files from storage
     * 
     * @return array<int, array{name: string, path: string, url: string, size: int, created_at: int, type: string}>
     */
    private function getCvFiles(): array
    {
        $cvFiles = [];
        
        // Get uploaded CVs
        $uploadedFiles = Storage::disk('public')->files('cvs/uploaded');
        foreach ($uploadedFiles as $file) {
            $cvFiles[] = [
                'name' => basename($file),
                'path' => $file,
                'url' => Storage::disk('public')->url($file),
                'size' => Storage::disk('public')->size($file),
                'created_at' => Storage::disk('public')->lastModified($file),
                'type' => 'uploaded',
            ];
        }
        
        // Get generated CVs
        $generatedFiles = Storage::disk('public')->files('cvs/generated');
        foreach ($generatedFiles as $file) {
            $cvFiles[] = [
                'name' => basename($file),
                'path' => $file,
                'url' => Storage::disk('public')->url($file),
                'size' => Storage::disk('public')->size($file),
                'created_at' => Storage::disk('public')->lastModified($file),
                'type' => 'generated',
            ];
        }
        
        // Sort by creation date (newest first)
        usort($cvFiles, function($a, $b) {
            return $b['created_at'] - $a['created_at'];
        });
        
        return $cvFiles;
    }

    /**
     * Set a CV as active/current
     */
    public function setActive(Request $request): RedirectResponse
    {
        $request->validate([
            'cv_path' => 'required|string',
        ]);

        /** @var User $user */
        $user = Auth::user();
        $cvPath = $request->cv_path;
        
        // Verify the file exists
        if (Storage::disk('public')->exists($cvPath)) {
            $user->cv_path = $cvPath;
            $user->save();
            
            return redirect()
                ->route('admin.cv.index')
                ->with('success', 'CV set as active successfully!');
        }
        
        return redirect()
            ->route('admin.cv.index')
            ->with('error', 'CV file not found.');
    }
}