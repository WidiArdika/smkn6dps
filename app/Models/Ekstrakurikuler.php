<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Str;

class Ekstrakurikuler extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'ekstrakurikulers';

    protected $fillable = ['judul', 'gambar', 'deskripsi'];

    public function sluggable(): array
    {
        return ['slug' => ['source' => 'judul']];
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = Str::slug($model->judul);
        });
    }
}
