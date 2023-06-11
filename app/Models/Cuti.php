<?php

namespace App\Models;

use App\Notifications\NotifikasiPengajuanCuti;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

class Cuti extends Model
{
    use HasFactory;
    protected $dates = ['updated_at'];

    protected $fillable = [
        'guru_id',
        'user_id',
        'kategori_id',
        'subkategori_id',
        'alasan',
        'durasi',
        'status',
        'tanggal_mulai',
        'tanggal_akhir',
        'file_bukti',
        'file_ttd',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    
    public function subkategori()
    {
        return $this->belongsTo(Subkategori::class);
    }

}
