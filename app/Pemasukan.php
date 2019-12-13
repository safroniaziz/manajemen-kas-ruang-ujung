<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    protected $fillable = [
        'kas_id','user_id','tanggal_pemasukan','periode_id','sumber_pemasukan','jumlah_pemasukan'
    ];
}
