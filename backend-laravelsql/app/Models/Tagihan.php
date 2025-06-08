<?php

// app/Models/Tagihan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table = 'tagihans';
protected $primaryKey = 'id_tagihan';
public $incrementing = false; // kalau pakai manual id_tagihan, tapi kalau sequence auto set true
public $timestamps = true;

    protected $fillable = [
        'id',
        'id_pemakaian',
        'jumlah_tagihan',
        'status_pembayaran',
    ];

    public function user()
{
    return $this->belongsTo(User::class, 'id', 'id'); 
    // id (di tagihan) mengarah ke id (di users)
}

    public function pemakaianAir()
    {
        return $this->belongsTo(PemakaianAir::class, 'id_pemakaian');
    }

    
}

