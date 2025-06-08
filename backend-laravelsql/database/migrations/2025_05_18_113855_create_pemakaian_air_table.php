<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemakaianAirTable extends Migration
{
    public function up()
    {
        Schema::create('pemakaian_air', function (Blueprint $table) {
            $table->id('id_pemakaian'); // Ini adalah primary key untuk tabel 'pemakaian_air' (BIGINT UNSIGNED AUTO_INCREMENT)

            // Kolom 'id' ini adalah foreign key yang merujuk ke users.id.
            // Tipe datanya HARUS SAMA dengan users.id. Karena users.id sekarang $table->id() (BIGINT UNSIGNED),
            // maka ini harus unsignedBigInteger.
            // DAN INI BUKAN auto_increment atau primary key lagi di tabel 'pemakaian_air'.
            $table->unsignedBigInteger('id'); // HANYA definisi kolom, tanpa PK/AI.

            $table->integer('meter_awal');
            $table->integer('meter_akhir');
            $table->string('bulan_tahun', 7)->nullable();
            $table->date('tanggal_input')->nullable();
            $table->integer('total_pemakaian')->nullable();
            $table->timestamps();

            // Definisi Foreign Key Constraint
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pemakaian_air');
    }
}