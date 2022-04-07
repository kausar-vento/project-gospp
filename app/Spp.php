<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    protected $fillable = [
        'tahun_ajaran',
    ];

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
