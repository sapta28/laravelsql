<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagihansTable extends Migration
{
    public function up()
    {
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id('id_tagihan');
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('id_pemakaian');
            $table->integer('jumlah_tagihan');
            $table->enum('status_pembayaran', ['sudah bayar', 'belum bayar']);
            $table->timestamps();

            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_pemakaian')->references('id_pemakaian')->on('pemakaian_air')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tagihans');
    }
}
