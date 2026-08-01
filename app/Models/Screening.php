<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    protected $fillable = [
        'pasien_id',
        'skor_total',
        'kategori_risiko',
        'status',
        'catatan',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
}