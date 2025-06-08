<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['nama', 'username', 'password', 'peran'];
    protected $hidden = ['password'];

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function pemakaianAir()
    {
        // Menyesuaikan foreign key di pemakaian_air yaitu 'id' (bukan 'user_id')
        return $this->hasMany(PemakaianAir::class, 'id', 'id');
    }

    public function tagihans()
{
    return $this->hasMany(Tagihan::class, 'id', 'id');
}


   public function pembayarans()
{
    return $this->hasManyThrough(
        Pembayaran::class,
        Tagihan::class,
        'id',          // Foreign key on Tagihan table (user_id)
        'id_tagihan',  // Foreign key on Pembayaran table
        'id',          // Local key on User table
        'id_tagihan'   // Local key on Tagihan table
    );
}

}
