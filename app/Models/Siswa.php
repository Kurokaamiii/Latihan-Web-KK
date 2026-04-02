<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model {
    protected $table = 'siswa';
    protected $primaryKey = 'nis';
    public $incrementing = false;
    protected $keyType = 'integer';
    protected $fillable = ['nis', 'username', 'password', 'kelas'];

    public function inputAspirasi() {
        return $this->hasMany(InputAspirasi::class, 'nis', 'nis');
    }
}
