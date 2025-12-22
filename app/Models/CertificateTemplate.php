<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateTemplate extends Model
{
    //
    protected $fillable = [
        'nama_template',
        'image_template',
        'layout_json'
    ];

    protected $casts = [
        'layout_json' => 'array', // otomatis jadi array
    ];

    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'template_id');
    }
}
