<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'technologies',
        'demo_url',
        'github_url',
        'image_path',
        'is_featured',
        'is_active',
        'order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'technologies' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Scope a query to only include active projects.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include featured projects.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to order projects by the order column.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('created_at', 'desc');
    }

    /**
     * Get the full URL to the project image.
     */
    public function imageUrl(): ?string
    {
        if ($this->image_path) {
            return Storage::url($this->image_path);
        }
        
        // Return a placeholder image
        return asset('assets/project.png');
    }

    /**
     * Get technologies as an array (handles both JSON and array).
     */
    public function getTechnologiesArrayAttribute(): array
    {
        if (is_array($this->technologies)) {
            return $this->technologies;
        }
        
        if (is_string($this->technologies)) {
            return json_decode($this->technologies, true) ?? [];
        }
        
        return [];
    }

    /**
     * Delete the project image from storage.
     */
    public function deleteImage(): void
    {
        if ($this->image_path && Storage::disk('public')->exists($this->image_path)) {
            Storage::disk('public')->delete($this->image_path);
        }
    }

    /**
     * Boot method to handle model events.
     */
    protected static function boot()
    {
        parent::boot();

        // Delete image when project is deleted
        static::deleting(function ($project) {
            $project->deleteImage();
        });
    }
}