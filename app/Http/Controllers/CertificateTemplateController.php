<?php

namespace App\Http\Controllers;

use App\Models\CertificateTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $templates = CertificateTemplate::latest()->get();

        return view('admin.template_sertifikat.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.template_sertifikat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_template' => 'required|string|max:255',
            'image_template' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'layout_json' => 'required'
        ]);

        // Upload gambar template
        $imagePath = $request->file('image_template')
            ->store('certificate/templates', 'public');

        CertificateTemplate::create([
            'nama_template' => $request->nama_template,
            'image_template' => $imagePath,
            'layout_json' => $request->layout_json,
        ]);

        return redirect()
            ->route('admin.template-sertifikat.index')
            ->with('success', 'Template sertifikat berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CertificateTemplate $certificateTemplate)
    {
        return view('admin.template_sertifikat.edit', compact('certificateTemplate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CertificateTemplate $certificateTemplate)
    {
        $request->validate([
            'nama_template' => 'required|string|max:255',
            'image_template' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'layout_json' => 'required'
        ]);

        $data = [
            'nama_template' => $request->nama_template,
            'layout_json' => $request->layout_json,
        ];

        // Jika upload gambar baru
        if ($request->hasFile('image_template')) {

            // Hapus gambar lama
            if ($certificateTemplate->image_template) {
                Storage::disk('public')->delete($certificateTemplate->image_template);
            }

            $data['image_template'] = $request->file('image_template')
                ->store('certificate/templates', 'public');
        }

        $certificateTemplate->update($data);

        return redirect()
            ->route('admin.template-sertifikat.index')
            ->with('success', 'Template sertifikat berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CertificateTemplate $certificateTemplate)
    { 
        // ===============================
        // Cegah hapus jika template dipakai sertifikat
        // ===============================
        if ($certificateTemplate->certificates()->count() > 0) {
            return redirect()
                ->back()
                ->with('error', 'Template tidak bisa dihapus karena masih digunakan oleh sertifikat');
        }

        // ===============================
        // Hapus file template image
        // ===============================
        if ($certificateTemplate->template_image) {
            $path = str_replace('storage/', '', $certificateTemplate->template_image);
            Storage::disk('public')->delete($path);
        }

        // ===============================
        // Hapus data template
        // ===============================
        $certificateTemplate->delete();

        return redirect()
            ->route('admin.template-sertifikat.index')
            ->with('success', 'Template sertifikat berhasil dihapus');
    }
}
