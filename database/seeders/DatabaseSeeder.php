<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admin')->insert([
            ['username' => 'admin', 'password' => 'admin123'],
        ]);

        DB::table('siswa')->insert([
            ['nis' => 1, 'username' => 'Reyhand', 'password' => 'siswa123', 'kelas' => 'XII RPL 1'],
            ['nis' => 2, 'username' => 'Budi',    'password' => 'siswa123', 'kelas' => 'XII TKJ'],
        ]);

        DB::table('kategori')->insert([
            ['id_kategori' => 1, 'ket_kategori' => 'Kebersihan'],
            ['id_kategori' => 2, 'ket_kategori' => 'Fasilitas'],
        ]);
    }
}
