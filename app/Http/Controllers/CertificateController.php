<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Student;
use App\Models\Program;
use App\Models\CertificateTemplate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certificates = Certificate::with([
            'student',
            'program',
            'template'
        ])->latest()->get();

        return view('admin.sertifikat.index', compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::with('user')
            ->join('users', 'users.id', '=', 'students.user_id')
            ->orderBy('users.name')
            ->select('students.*')
            ->paginate(10);
        $programs = Program::orderBy('nama_program')->get();
        $templates = CertificateTemplate::orderBy('nama_template')->get();

        return view('admin.sertifikat.create', compact(
            'students',
            'programs',
            'templates'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'program_id' => 'required|exists:programs,id',
            'template_id' => 'required|exists:certificate_templates,id',
            'issued_date' => 'required|date',
        ]);

        /* ================= CREATE CERTIFICATE ================= */

        $code = 'WC-' . strtoupper(Str::random(10));

        $certificate = Certificate::create([
            'certificate_code' => $code,
            'student_id' => $request->student_id,
            'program_id' => $request->program_id,
            'template_id' => $request->template_id,
            'issued_by' => auth()->id(),
            'issued_date' => $request->issued_date,
            'status' => 'active',
            'qr_code_path' => '',
            'pdf_path' => '',
        ]);

        /* ================= QR CODE ================= */

        $qrFileName = Str::random(40) . '.png';
        $qrPath = "qr/{$qrFileName}";

        $qrCode = new QrCode(
            data: route('certificate.verify', $certificate->certificate_code),
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::High,
            size: 300,
            margin: 10
        );

        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        Storage::disk('public')->put($qrPath, $result->getString());

        /* ================= PDF ================= */

        $template = CertificateTemplate::findOrFail($request->template_id);

        // decode layout json
        $layout = json_decode($template->layout_json, true);

        // PATH ABSOLUT UNTUK DOMPDF (PENTING!)
        $backgroundPath = storage_path('app/public/' . $template->image_template);
        $qrAbsolutePath = storage_path('app/public/' . $qrPath);

        $pdf = Pdf::loadView('pdf.certificate', [
            'certificate' => $certificate,
            'template' => $template,
            'layout' => $layout,
            'backgroundPath' => $backgroundPath,
            'qrPath' => $qrAbsolutePath,
        ])->setPaper('a4', 'landscape');

        $pdfPath = "certificates/{$certificate->certificate_code}.pdf";
        Storage::disk('public')->put($pdfPath, $pdf->output());

        /* ================= UPDATE PATH ================= */

        $certificate->update([
            'qr_code_path' => $qrPath,
            'pdf_path' => $pdfPath,
        ]);

        return redirect()
            ->route('admin.certificates.index')
            ->with('success', 'Sertifikat berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Certificate $certificate)
    {
        return response()->file(
            storage_path('app/public/' . $certificate->pdf_path),
            [
                'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                'Pragma' => 'no-cache',
                'Expires' => '0',
            ]
        );

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Certificate $certificate)
    {
        $programs = Program::orderBy('nama_program')->get();
        $templates = CertificateTemplate::orderBy('nama_template')->get();
        return view('admin.sertifikat.edit', compact([
            'certificate',
            'programs',
            'templates'
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certificate $certificate)
    {
        $request->validate([
            'program_id' => 'required|exists:programs,id',
            'template_id' => 'required|exists:certificate_templates,id',
            'issued_date' => 'required|date',
            'status' => 'required|in:active,revoked',
        ]);

        /* ================= UPDATE DATABASE ================= */
        $certificate->update([
            'program_id' => $request->program_id,
            'template_id' => $request->template_id,
            'issued_date' => $request->issued_date,
            'status' => $request->status,
        ]);

        /* 🔥 PENTING: REFRESH OBJECT */
        $certificate->refresh(); // AMBIL DATA TERBARU DARI DB
        $certificate->load('program');

        /* ================= HAPUS PDF LAMA ================= */
        if ($certificate->pdf_path && Storage::disk('public')->exists($certificate->pdf_path)) {
            Storage::disk('public')->delete($certificate->pdf_path);
        }

        $program = Program::findOrFail($request->program_id);
        $template = CertificateTemplate::findOrFail($request->template_id);

        /* ================= DECODE LAYOUT ================= */
        $layout = json_decode($template->layout_json, true);

        /* ================= PATH ABSOLUT ================= */
        $backgroundPath = storage_path('app/public/' . $template->image_template);
        $qrAbsolutePath = storage_path('app/public/' . $certificate->qr_code_path);

        /* ================= GENERATE PDF BARU ================= */
        $pdf = Pdf::loadView('pdf.certificate', [
            'certificate' => $certificate,
            'program' => $program,
            'template' => $template,
            'layout' => $layout,
            'backgroundPath' => $backgroundPath,
            'qrPath' => $qrAbsolutePath,
        ])->setPaper('a4', 'landscape');

        $pdfPath = "certificates/{$certificate->certificate_code}-" . time() . ".pdf";
        Storage::disk('public')->put($pdfPath, $pdf->output());

        /* ================= SIMPAN PATH PDF ================= */
        $certificate->update([
            'pdf_path' => $pdfPath,
        ]);

        return redirect()
            ->route('admin.certificates.index')
            ->with('success', 'Sertifikat berhasil diperbarui & PDF diganti');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Certificate $certificate)
    {
        // ===============================
        // Hapus file PDF jika ada
        // ===============================
        if ($certificate->pdf_path) {
            $pdfPath = str_replace('storage/', '', $certificate->pdf_path);
            Storage::disk('public')->delete($pdfPath);
        }

        // ===============================
        // Hapus file QR jika ada
        // ===============================
        if ($certificate->qr_code_path) {
            $qrPath = str_replace('storage/', '', $certificate->qr_code_path);
            Storage::disk('public')->delete($qrPath);
        }

        // ===============================
        // Hapus data dari database
        // ===============================
        $certificate->delete();

        return redirect()
            ->route('admin.certificates.index')
            ->with('success', 'Sertifikat & file berhasil dihapus');
    }

}
