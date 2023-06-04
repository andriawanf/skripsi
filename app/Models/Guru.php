<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Guru extends Model
{
    use HasFactory, HasApiTokens, Notifiable;


    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'pangkat',
        'satuan_organisasi',
        'saldo_cuti',
    ];

    public function cutis()
    {
        return $this->hasMany(Cuti::class);
    }

    public function user()
{
    return $this->belongsTo(User::class);
}
}
