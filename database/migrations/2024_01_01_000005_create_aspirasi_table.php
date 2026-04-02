<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('aspirasi', function (Blueprint $table) {
            $table->integer('id_aspirasi')->primary();
            $table->enum('status', ['Menunggu', 'Proses', 'Selesai'])->default('Menunggu');
            $table->integer('id_kategori')->nullable();
            $table->integer('id_pelaporan')->nullable();
            $table->text('feedback')->nullable();
            $table->integer('rating')->nullable();
            $table->timestamps();
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori');
            $table->foreign('id_pelaporan')->references('id_pelaporan')->on('input_aspirasi')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('aspirasi'); }
};
