<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemakaianAir extends Model
{
    protected $table = 'pemakaian_air';
    protected $primaryKey = 'id_pemakaian';
    public $timestamps = true;

    protected $fillable = [
        'id', // foreign key ke users.id
        'meter_awal',
        'meter_akhir',
        'bulan_tahun',
        'tanggal_input',
        'total_pemakaian',
    ];

    public function user()
    {
        // foreignKey (pemakaian_air.id), ownerKey (users.id)
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
