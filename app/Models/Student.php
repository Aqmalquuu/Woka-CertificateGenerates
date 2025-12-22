<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $fillable = [
        'user_id',
        'nis',
        'asal_sekolah',
    ];

    public function user()  {
        return $this->belongsTo(User::class);
    }

    public function certificates() {
        return $this->hasMany(Certificate::class);
    }
}
