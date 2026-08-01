<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'usia',
        'jenis_kelamin',
        'status',
        'status_screening',
        'risiko_terakhir',
    ];

    public function screenings()
    {
        return $this->hasMany(Screening::class);
    }
}