<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{


    public function user()
    {
    return $this->hasMany('App\User');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

}