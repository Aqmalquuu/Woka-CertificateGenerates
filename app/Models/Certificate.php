<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function regeneratePdf()
    {
        // Refresh relasi agar data terbaru
        $this->load('program', 'template');

        // Hapus PDF lama
        if ($this->pdf_path && Storage::disk('public')->exists($this->pdf_path)) {
            Storage::disk('public')->delete($this->pdf_path);
        }

        $program = $this->program;
        $template = $this->template;

        if (!$program || !$template) {
            throw new \Exception("Program atau template tidak ditemukan untuk sertifikat ID: " . $this->id);
        }

        $layout = json_decode($template->layout_json, true);
        $backgroundPath = storage_path('app/public/' . $template->image_template);
        $qrAbsolutePath = storage_path('app/public/' . $this->qr_code_path);

        $pdf = Pdf::loadView('pdf.certificate', [
            'certificate' => $this,
            'program' => $program,
            'template' => $template,
            'layout' => $layout,
            'backgroundPath' => $backgroundPath,
            'qrPath' => $qrAbsolutePath,
        ])->setPaper('a4', 'landscape');

        $pdfPath = "certificates/{$this->certificate_code}-" . time() . ".pdf";
        Storage::disk('public')->put($pdfPath, $pdf->output());

        $this->update(['pdf_path' => $pdfPath]);
    }
}
