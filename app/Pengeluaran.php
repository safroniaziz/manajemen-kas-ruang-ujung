<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $fillable = [
        'kas_id','user_id','tanggal_pengeluaran','periode_id','keperluan','jumlah_pemasukan'
    ];
}
