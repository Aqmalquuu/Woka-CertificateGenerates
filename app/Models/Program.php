<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    //
    protected $fillable = [
        'nama_program',
        'jenis',
        'durasi',
    ];

    public function certificates() {
        return $this->hasMany(Certificate::class);
    }
}
