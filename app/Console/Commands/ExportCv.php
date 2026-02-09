<?php

namespace App\Console\Commands;

use App\Models\Project;
use Illuminate\Console\Command;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportCv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cv:export {--template=classic : The CV template to use (classic|minimal)} {--output= : Custom output filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export CV as PDF with selected template';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $template = $this->option('template') ?? 'classic';
        
        // Validate template
        if (!in_array($template, ['classic', 'minimal'])) {
            $this->error('Invalid template. Choose either "classic" or "minimal".');
            return 1;
        }

        $this->info("Generating CV with {$template} template...");

        try {
            // Get featured projects
            $projects = Project::featured()
                ->active()
                ->ordered()
                ->get();

            // Generate PDF
            $pdf = Pdf::loadView("cv.{$template}", compact('projects'));
            
            // Set PDF options
            $pdf->setPaper('a4', 'portrait');
            $pdf->setOption('enable-local-file-access', true);

            // Determine output filename
            $filename = $this->option('output') 
                ?? 'cv_' . strtolower(config('portfolio.name', 'developer')) . '_' . $template . '.pdf';
            
            // Remove spaces and special characters
            $filename = preg_replace('/[^A-Za-z0-9_\-.]/', '_', $filename);
            
            // Ensure .pdf extension
            if (!str_ends_with($filename, '.pdf')) {
                $filename .= '.pdf';
            }

            // Save to storage/app/public/cv
            $path = storage_path('app/public/cv/' . $filename);
            
            // Create directory if it doesn't exist
            if (!file_exists(dirname($path))) {
                mkdir(dirname($path), 0755, true);
            }

            $pdf->save($path);

            $this->info("✓ CV exported successfully!");
            $this->line("Template: {$template}");
            $this->line("Location: {$path}");
            $this->line("URL: " . asset('storage/cv/' . $filename));

            return 0;
        } catch (\Exception $e) {
            $this->error("Failed to export CV: " . $e->getMessage());
            return 1;
        }
    }
}