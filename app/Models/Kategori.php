<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kategori_id',
    ];

    public function cutis()
    {
        return $this->hasMany(Cuti::class);
    }

    public function subkategoris()
    {
        return $this->hasMany(Subkategori::class);
    }
}
