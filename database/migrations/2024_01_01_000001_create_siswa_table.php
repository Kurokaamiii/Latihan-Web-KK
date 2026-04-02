<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('siswa', function (Blueprint $table) {
            $table->integer('nis')->primary();
            $table->string('username', 100);
            $table->string('password', 300);
            $table->string('kelas', 10)->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('siswa'); }
};
