<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blanko', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->string('kecamatan');
            $table->string('desa');
            $table->string('detail')->nullable();
            $table->enum('tipe', ['VIP', 'VVIP', 'Normal'])->default('Normal');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->string('maps')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blanko');
    }
};
