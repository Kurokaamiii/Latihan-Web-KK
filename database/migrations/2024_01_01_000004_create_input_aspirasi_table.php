<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('input_aspirasi', function (Blueprint $table) {
            $table->integer('id_pelaporan')->primary();
            $table->integer('nis')->nullable();
            $table->integer('id_kategori')->nullable();
            $table->string('lokasi', 50)->nullable();
            $table->string('ket', 255)->nullable();
            $table->timestamps();
            $table->foreign('nis')->references('nis')->on('siswa')->onDelete('cascade');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori');
        });
    }
    public function down(): void { Schema::dropIfExists('input_aspirasi'); }
};
