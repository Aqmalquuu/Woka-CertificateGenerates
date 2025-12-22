@extends('partials.layouts.master')

@section('title', 'Admin | Tambah Template Sertifikat')
@section('title-sub', 'W-Cert')
@section('pagetitle', 'Tambah Template Sertifikat')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card courses-card">
            <div class="card-header">
                <h5 class="card-title mb-0">Tambah Template Sertifikat</h5>
            </div>

            <form action="{{ route('admin.template-sertifikat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label">Nama Template</label>
                        <input type="text" name="nama_template" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Background Sertifikat</label>
                        <input type="file" name="image_template" class="form-control" accept="image/*" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Layout JSON</label>
                        <textarea name="layout_json" rows="8" class="form-control" required readonly>{
    "student_name": { "top": "48%", "left": "50%", "font_size": "36px" },
    "program": { "top": "58%", "left": "50%", "font_size": "18px" },
    "certificate_number": { "bottom": "130px", "right": "100px", "font_size": "14px" },
    "date": { "bottom": "90px", "right": "100px", "font_size": "14px" },
    "qr": { "bottom": "90px", "left": "100px", "size": "90px" }
}</textarea>
                        <small class="text-muted">
                            Gunakan format JSON yang valid
                        </small>
                    </div>

                </div>

                <div class="card-footer text-end">
                    <a href="{{ route('admin.template-sertifikat.index') }}" class="btn btn-light">Batal</a>
                    <button class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection