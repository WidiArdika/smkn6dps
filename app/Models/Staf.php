<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Traits\DeletesFileOnModelDelete;

class Staf extends Model
{
    use HasFactory, DeletesFileOnModelDelete;

    protected $table = 'stafs';

    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'foto'
    ];

    // Kolom tempat nama file disimpan
    protected $fileColumn = 'foto';

    public function getFotoUrlAttribute()
    {
        return asset('storage/' . $this->foto);
    }
}
