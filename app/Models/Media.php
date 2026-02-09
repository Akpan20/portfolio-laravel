<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\FilesystemAdapter;

class Media extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'collection_name',
        'file_name',
        'mime_type',
        'disk',
        'size',
        'custom_properties',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'custom_properties' => 'array',
        'size' => 'integer',
    ];

    /**
     * Get the owning mediable model.
     */
    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the filesystem disk adapter.
     */
    protected function getDisk(): FilesystemAdapter
    {
        return Storage::disk($this->disk);
    }

    /**
     * Get the full URL for the media.
     */
    public function getUrl(): string
    {
        return $this->getDisk()->url($this->file_name);
    }

    /**
     * Get the full filesystem path for the media.
     */
    public function getPath(): string
    {
        return $this->getDisk()->path($this->file_name);
    }

    /**
     * Check if the media file exists.
     */
    public function exists(): bool
    {
        return $this->getDisk()->exists($this->file_name);
    }

    /**
     * Delete the media file from storage.
     */
    public function deleteFile(): bool
    {
        if ($this->exists()) {
            return $this->getDisk()->delete($this->file_name);
        }

        return true;
    }

    /**
     * Get a custom property value.
     */
    public function getCustomProperty(string $key, mixed $default = null): mixed
    {
        return $this->custom_properties[$key] ?? $default;
    }

    /**
     * Set a custom property value.
     */
    public function setCustomProperty(string $key, mixed $value): self
    {
        $properties = $this->custom_properties ?? [];
        $properties[$key] = $value;

        $this->custom_properties = $properties;

        return $this;
    }

    /**
     * Get human-readable file size.
     */
    public function getHumanReadableSize(): string
    {
        $bytes = $this->size;
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Check if media is an image.
     */
    public function isImage(): bool
    {
        return str_starts_with($this->mime_type, 'image/');
    }

    /**
     * Check if media is a video.
     */
    public function isVideo(): bool
    {
        return str_starts_with($this->mime_type, 'video/');
    }

    /**
     * Check if media is a document.
     */
    public function isDocument(): bool
    {
        return in_array($this->mime_type, [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ], true);
    }

    /**
     * Scope to filter by collection.
     */
    public function scopeInCollection($query, string $collection)
    {
        return $query->where('collection_name', $collection);
    }

    /**
     * Scope to filter by mime type.
     */
    public function scopeOfMimeType($query, string $mimeType)
    {
        return $query->where('mime_type', $mimeType);
    }

    /**
     * Boot the model.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::deleting(function (self $media): void {
            $media->deleteFile();
        });
    }
}
