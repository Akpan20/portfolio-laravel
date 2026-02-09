<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateFileUpload
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            
            // Additional security checks
            $allowedMimes = ['image/jpeg', 'image/png', 'image/webp'];
            
            if (!in_array($file->getMimeType(), $allowedMimes)) {
                return back()->withErrors(['avatar' => 'Invalid file type.']);
            }
            
            // Check for malicious content (basic check)
            if ($file->getSize() < 100) {
                return back()->withErrors(['avatar' => 'File too small.']);
            }
        }

        return $next($request);
    }
}