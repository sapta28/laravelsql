<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // INI PENTING! Ini akan membuat 'id' sebagai BIGINT UNSIGNED AUTO_INCREMENT
                          // Ini adalah standar Laravel terbaru dan kompatibel dengan unsignedBigInteger.
            $table->string('nama', 20);
            $table->string('username', 20)->unique();
            $table->string('password');
            $table->string('peran', 10);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('users');
    }
};