<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Certificate extends Model
{
    //
    protected $fillable = [
        'certificate_code',
        'student_id',
        'program_id',
        'template_id',
        'issued_by',
        'issued_date',
        'qr_code_path',
        'pdf_path',
        'status',
        'verified_at'
    ];

    protected $casts =[
      'issued_date' => 'date',  
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function template()
    {
        return $this->belongsTo(CertificateTemplate::class, 'template_id');
    }

    public function issued()
    {
        return $this->belongsTo(User::class, 'issued_by');
    }
}
