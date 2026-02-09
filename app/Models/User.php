<?php

namespace App\Models;

use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasMedia;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_path',
        'cover_image',
        'home_image',  // Add this
        'cv_path',
        'cv_title',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    protected $appends = [
        'avatar_url',
        'cover_image_url',
        'home_image_url',  // Add this
        'cv_url',
        'cv_size',
    ];

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    /**
     * Avatar URL (with cache busting + fallback) - REQUIRES AUTH
     */
    public function getAvatarUrlAttribute(): string
    {
        if (!$this->hasAvatar()) {
            return $this->defaultAvatarUrl();
        }

        return $this->versionedStorageUrl($this->avatar_path);
    }

    /**
     * Cover Image URL (PUBLIC - no auth required)
     */
    public function getCoverImageUrlAttribute(): string
    {
        if (!$this->hasCoverImage()) {
            return 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 1080"%3E%3Cdefs%3E%3ClinearGradient id="grad" x1="0%25" y1="0%25" x2="100%25" y2="100%25"%3E%3Cstop offset="0%25" style="stop-color:rgb(17,24,39);stop-opacity:1" /%3E%3Cstop offset="50%25" style="stop-color:rgb(67,56,202);stop-opacity:1" /%3E%3Cstop offset="100%25" style="stop-color:rgb(109,40,217);stop-opacity:1" /%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width="1920" height="1080" fill="url(%23grad)" /%3E%3C/svg%3E';
        }

        return $this->versionedStorageUrl($this->cover_image);
    }

    /**
     * Home Image URL (PUBLIC - no auth required, different from avatar)
     */
    public function getHomeImageUrlAttribute(): string
    {
        if (!$this->hasHomeImage()) {
            // Default home page image
            return asset('assets/profile.png');
        }

        return $this->versionedStorageUrl($this->home_image);
    }

    /**
     * CV public URL.
     */
    public function getCvUrlAttribute(): ?string
    {
        if (!$this->cvExists()) {
            return null;
        }

        return Storage::disk('public')->url($this->cv_path);
    }

    /**
     * Human-readable CV size.
     */
    public function getCvSizeAttribute(): ?string
    {
        if (!$this->cvExists()) {
            return null;
        }

        try {
            $bytes = Storage::disk('public')->size($this->cv_path);

            $units = ['B', 'KB', 'MB', 'GB', 'TB'];
            $i = 0;

            while ($bytes >= 1024 && $i < count($units) - 1) {
                $bytes /= 1024;
                $i++;
            }

            return round($bytes, 1) . ' ' . $units[$i];
        } catch (\Throwable) {
            return null;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Media Presence Checks
    |--------------------------------------------------------------------------
    */

    public function hasAvatar(): bool
    {
        return $this->fileExists($this->avatar_path);
    }

    public function hasCoverImage(): bool
    {
        return $this->fileExists($this->cover_image);
    }

    public function hasHomeImage(): bool
    {
        return $this->fileExists($this->home_image);
    }

    protected function cvExists(): bool
    {
        return $this->fileExists($this->cv_path);
    }

    /*
    |--------------------------------------------------------------------------
    | File Deletion Helpers
    |--------------------------------------------------------------------------
    */

    public function deleteAvatar(): void
    {
        $this->deleteFile($this->avatar_path);
        $this->avatar_path = null;
        $this->saveQuietly();
    }

    public function deleteCoverImage(): void
    {
        $this->deleteFile($this->cover_image);
        $this->cover_image = null;
        $this->saveQuietly();
    }

    public function deleteHomeImage(): void
    {
        $this->deleteFile($this->home_image);
        $this->home_image = null;
        $this->saveQuietly();
    }

    /*
    |--------------------------------------------------------------------------
    | Role / Authorization Helpers
    |--------------------------------------------------------------------------
    */

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /*
    |--------------------------------------------------------------------------
    | Internal Utilities
    |--------------------------------------------------------------------------
    */

    /**
     * Generate versioned storage URL.
     */
    protected function versionedStorageUrl(string $path): string
    {
        $disk = Storage::disk('public');
        $url  = $disk->url($path);

        try {
            $mtime = $disk->lastModified($path);
            return $mtime ? "{$url}?v={$mtime}" : $url;
        } catch (\Throwable) {
            return $url;
        }
    }

    /**
     * Default avatar fallback.
     */
    protected function defaultAvatarUrl(): string
    {
        return 'https://ui-avatars.com/api/?name=' .
            urlencode($this->name ?: 'User') .
            '&background=4F46E5&color=fff&size=256';
    }

    /**
     * Check file existence on public disk.
     */
    protected function fileExists(?string $path): bool
    {
        return !empty($path)
            && Storage::disk('public')->exists($path);
    }

    /**
     * Delete file safely.
     */
    protected function deleteFile(?string $path): void
    {
        if ($this->fileExists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}