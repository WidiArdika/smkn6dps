<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['judul', 'gambar', 'deskripsi', 'tanggal', 'status'];

    public function sluggable(): array
    {
        return [
            'slug' => ['source' => 'judul']
        ];
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = Str::slug($model->judul);
        });
    }

    // Scope untuk berita yang sudah dipublish
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Scope untuk draft
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    // Helper method untuk cek status
    public function isPublished()
    {
        return $this->status === 'published';
    }

    public function isDraft()
    {
        return $this->status === 'draft';
    }
}