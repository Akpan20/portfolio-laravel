<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'description', 'url', 'image'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopeSearch($q, $term = null)
    {
        if (!$term) return $q;
        return $q->whereFullText(['title','description'], $term);
    }
}
