<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_tagihan',
        'metode_pembayaran',
        'bukti_pembayaran',
        'status_pembayaran',
    ];

   public function tagihan()
{
    return $this->belongsTo(Tagihan::class, 'id_tagihan', 'id_tagihan');
}

public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
