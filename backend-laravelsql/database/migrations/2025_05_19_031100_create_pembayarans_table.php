<?php

// database/migrations/xxxx_xx_xx_create_pembayarans_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    public function up()
{
    Schema::create('pembayarans', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_tagihan');
        $table->enum('metode_pembayaran', ['online', 'offline']);
        $table->string('bukti_pembayaran')->nullable(); // path gambar
        $table->enum('status_pembayaran', ['menunggu konfirmasi', 'diterima', 'ditolak'])->default('menunggu konfirmasi');
        $table->timestamps();

        $table->foreign('id_tagihan')->references('id_tagihan')->on('tagihans')->onDelete('cascade');
    });
}

    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
}

