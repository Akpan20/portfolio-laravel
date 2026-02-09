<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Image processing service
 * 
 * Note: For advanced image processing, install intervention/image package:
 * composer require intervention/image
 */
class ImageService
{
    /**
     * Process and store an avatar image.
     *
     * @param UploadedFile $file
     * @param string|null $oldPath
     * @return string The path to the stored image
     */
    public function processAvatar(UploadedFile $file, ?string $oldPath = null): string
    {
        // Delete old avatar if exists
        if ($oldPath) {
            Storage::disk('public')->delete($oldPath);
        }

        // Create unique filename
        $extension = $file->getClientOriginalExtension();
        $filename = 'avatars/avatar_' . uniqid() . '_' . time() . '.' . $extension;

        // Check if Intervention Image is available
        if ($this->hasInterventionImage()) {
            return $this->processWithIntervention($file, $filename);
        }

        // Fallback: Store file directly without processing
        return $this->processWithoutIntervention($file, $filename);
    }

    /**
     * Check if Intervention Image package is installed.
     *
     * @return bool
     */
    protected function hasInterventionImage(): bool
    {
        return class_exists('Intervention\Image\ImageManager');
    }

    /**
     * Process image using Intervention Image library.
     *
     * @param UploadedFile $file
     * @param string $filename
     * @return string
     */
    protected function processWithIntervention(UploadedFile $file, string $filename): string
    {
        try {
            $image = app('image')->make($file)
                ->fit(512, 512)
                ->encode('jpg', 85);

            // Get the encoded image content
            $encodedImage = (string) $image;
            
            Storage::disk('public')->put($filename, $encodedImage);

            return $filename;
        } catch (\Exception $e) {
            // Fallback to direct storage if processing fails
            return $this->processWithoutIntervention($file, $filename);
        }
    }

    /**
     * Process image without Intervention Image library.
     *
     * @param UploadedFile $file
     * @param string $filename
     * @return string
     */
    protected function processWithoutIntervention(UploadedFile $file, string $filename): string
    {
        // Store the file directly
        $path = $file->storeAs('avatars', basename($filename), 'public');

        return $path;
    }

    /**
     * Validate image dimensions.
     *
     * @param UploadedFile $file
     * @param int $minWidth
     * @param int $minHeight
     * @return bool
     */
    public function validateImageDimensions(UploadedFile $file, int $minWidth = 200, int $minHeight = 200): bool
    {
        // Check if Intervention Image is available
        if ($this->hasInterventionImage()) {
            try {
                $image = app('image')->make($file);
                $width = method_exists($image, 'width') ? $image->width() : 0;
                $height = method_exists($image, 'height') ? $image->height() : 0;
                
                return $width >= $minWidth && $height >= $minHeight;
            } catch (\Exception $e) {
                // Fall through to native PHP method
            }
        }

        // Fallback: Use getimagesize
        try {
            $dimensions = getimagesize($file->getRealPath());
            if ($dimensions === false) {
                return false;
            }
            return $dimensions[0] >= $minWidth && $dimensions[1] >= $minHeight;
        } catch (\Exception $e) {
            return true;
        }
    }
}