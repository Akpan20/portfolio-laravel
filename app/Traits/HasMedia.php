<?php

namespace App\Traits;

use App\Models\Media;
use Illuminate\Http\UploadedFile;

trait HasMedia
{
    /**
     * Get all media for the model.
     */
    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    /**
     * Add media to the model.
     */
    public function addMedia(UploadedFile $file, string $collection = 'default'): Media
    {
        $path = $file->store($collection, 'public');

        return $this->media()->create([
            'collection_name' => $collection,
            'file_name' => $path,
            'mime_type' => $file->getMimeType(),
            'disk' => 'public',
            'size' => $file->getSize(),
        ]);
    }

    /**
     * Get media from a specific collection.
     */
    public function getMedia(string $collection = 'default')
    {
        return $this->media()->where('collection_name', $collection)->get();
    }

    /**
     * Get the first media item from a collection.
     */
    public function getFirstMedia(string $collection = 'default'): ?Media
    {
        return $this->media()->where('collection_name', $collection)->first();
    }

    /**
     * Clear all media from a collection.
     */
    public function clearMediaCollection(string $collection = 'default'): void
    {
        $media = $this->getMedia($collection);

        foreach ($media as $item) {
            $item->deleteFile();
            $item->delete();
        }
    }
}