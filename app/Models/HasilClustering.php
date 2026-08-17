<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilClustering extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fitur_pengguna_id',
        'cluster',
        'tingkat_risiko',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fiturPengguna()
    {
        return $this->belongsTo(FiturPengguna::class);
    }
}
