@extends('partials.layouts.master')

@section('title', 'Admin | Update Template Sertifikat')
@section('title-sub', 'W-Cert')
@section('pagetitle', 'Update Template Sertifikat')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card courses-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Update Template Sertifikat</h5>
                </div>

                <form action="{{ route('admin.template-sertifikat.update', $certificateTemplate->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Nama Template</label>
                            <input type="text" name="nama_template" class="form-control"
                                value="{{ old('nama_template', $certificateTemplate->nama_template) }}" required>
                            @error('nama_template')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Background Sertifikat</label>

                            {{-- PREVIEW GAMBAR --}}
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $certificateTemplate->image_template) }}"
                                    alt="Background Sertifikat" id="imagePreview" class="img-thumbnail"
                                    style="max-height: 200px; cursor: pointer;" data-bs-toggle="modal"
                                    data-bs-target="#imagePreviewModal">
                            </div>

                            {{-- INPUT FILE --}}
                            <input type="file" name="image_template" class="form-control" accept="image/*"
                                onchange="previewImage(this)">
                        </div>
                        <div class="modal fade" id="imagePreviewModal" tabindex="-1">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body text-center">
                                        <img src="{{ asset('storage/' . $certificateTemplate->image_template) }}"
                                            id="modalImage" class="img-fluid">
                                    </div>
                                </div>
                            </div>
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
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('imagePreview').src = e.target.result;
                    document.getElementById('modalImage').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection