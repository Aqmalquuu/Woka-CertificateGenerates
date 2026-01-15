@extends('partials.layouts.master')

@section('title', 'Admin | Update Template Sertifikat')
@section('title-sub', 'W-Certif')
@section('pagetitle', 'Update Template Sertifikat')

@section('content')
<div class="row">
  <div class="col-xl-12">
    <div class="card courses-card">
      <div class="card-header">
        <h5 class="card-title mb-0">Update Template Sertifikat</h5>
      </div>

      <form action="{{ route('admin.template-sertifikat.update', $certificateTemplate->id) }}"
            method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card-body">

            {{-- NAMA TEMPLATE --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Template</label>
                <input type="text"
                    name="nama_template"
                    class="form-control @error('nama_template') is-invalid @enderror"
                    value="{{ old('nama_template', $certificateTemplate->nama_template) }}"
                    required>

                @error('nama_template')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- BACKGROUND --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Background Sertifikat</label>

                {{-- PREVIEW --}}
                <div class="mb-2">
                <img
                    src="{{ asset('storage/' . $certificateTemplate->image_template) }}"
                    id="imagePreview"
                    class="img-thumbnail"
                    style="max-height:200px; cursor:pointer;"
                    data-bs-toggle="modal"
                    data-bs-target="#imagePreviewModal"
                    alt="Preview Background">
                </div>

                {{-- INPUT FILE --}}
                <input type="file"
                    name="image_template"
                    class="form-control"
                    accept="image/*"
                    onchange="previewImage(this)">

                    <small class="text-muted">
                    Kosongkan jika tidak ingin mengganti background
                    </small>
            </div>

            {{-- MODAL PREVIEW --}}
            <div class="modal fade" id="imagePreviewModal" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                        <img
                            src="{{ asset('storage/' . $certificateTemplate->image_template) }}"
                            id="modalImage"
                            class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>

            {{-- ================= LAYOUT ================= --}}
            <div class="mb-2">
            <label class="form-label fw-bold mb-2">Layout Sertifikat</label>

            {{-- ================= STUDENT NAME ================= --}}
            <fieldset class="border rounded p-3 mb-3">
            <legend class="float-none w-auto px-2 fs-6 fw-semibold text-muted">Nama Siswa</legend>

            @php
            $student = $layout['student_name'] ?? [];
            @endphp

            <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label small">Top</label>
                <input type="text" class="form-control"
                name="layout[student_name][top]"
                value="{{ old('layout.student_name.top', $student['top'] ?? '') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label small">Left</label>
                <input type="text" class="form-control"
                name="layout[student_name][left]"
                value="{{ old('layout.student_name.left', $student['left'] ?? '') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label small">Font Size</label>
                <input type="text" class="form-control"
                name="layout[student_name][font_size]"
                value="{{ old('layout.student_name.font_size', $student['font_size'] ?? '') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label small">Font Family</label>
                <select class="form-select" name="layout[student_name][font_family]">
                <option value="">-- Pilih Font --</option>
                @foreach ([
                    'Times New Roman','Georgia','Garamond','Playfair Display',
                    'Libre Baskerville','Cinzel','Trajan Pro','GreatVibes'
                ] as $font)
                    <option value="{{ $font }}"
                    {{ old('layout.student_name.font_family', $student['font_family'] ?? '') === $font ? 'selected' : '' }}>
                    {{ $font }}
                    </option>
                @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label small">Font Weight</label>
                <select class="form-select" name="layout[student_name][font_weight]">
                <option value="normal"
                    {{ old('layout.student_name.font_weight', $student['font_weight'] ?? '') === 'normal' ? 'selected' : '' }}>
                    Normal
                </option>
                <option value="bold"
                    {{ old('layout.student_name.font_weight', $student['font_weight'] ?? '') === 'bold' ? 'selected' : '' }}>
                    Bold
                </option>
                </select>
            </div>
            </div>
            </fieldset>

            {{-- ================= SUPPORTING TEXT ================= --}}
            <fieldset class="border rounded p-3 mb-3">
            <legend class="float-none w-auto px-2 fs-6 fw-semibold text-muted">Supporting Text</legend>

            @php
            $support = $layout['supporting_text'] ?? [];
            @endphp

            <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label small">Top</label>
                <input type="text" class="form-control"
                name="layout[supporting_text][top]"
                value="{{ old('layout.supporting_text.top', $support['top'] ?? '') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label small">Left</label>
                <input type="text" class="form-control"
                name="layout[supporting_text][left]"
                value="{{ old('layout.supporting_text.left', $support['left'] ?? '') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label small">Width</label>
                <input type="text" class="form-control"
                name="layout[supporting_text][width]"
                value="{{ old('layout.supporting_text.width', $support['width'] ?? '') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label small">Font Size</label>
                <input type="text" class="form-control"
                name="layout[supporting_text][font_size]"
                value="{{ old('layout.supporting_text.font_size', $support['font_size'] ?? '') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label small">Text Align</label>
                <select class="form-select" name="layout[supporting_text][text_align]">
                @foreach (['left','center','right'] as $align)
                    <option value="{{ $align }}"
                    {{ old('layout.supporting_text.text_align', $support['text_align'] ?? '') === $align ? 'selected' : '' }}>
                    {{ ucfirst($align) }}
                    </option>
                @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label small">Line Height</label>
                <input type="text" class="form-control"
                name="layout[supporting_text][line_height]"
                value="{{ old('layout.supporting_text.line_height', $support['line_height'] ?? '') }}">
            </div>
            </div>
            </fieldset>

            {{-- ================= PROGRAM ================= --}}
            <fieldset class="border rounded p-3 mb-3">
            <legend class="float-none w-auto px-2 fs-6 fw-semibold text-muted">Program</legend>

            @php $program = $layout['program'] ?? []; @endphp

            <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label small">Top</label>
                <input type="text" class="form-control"
                name="layout[program][top]"
                value="{{ old('layout.program.top', $program['top'] ?? '') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label small">Left</label>
                <input type="text" class="form-control"
                name="layout[program][left]"
                value="{{ old('layout.program.left', $program['left'] ?? '') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label small">Font Size</label>
                <input type="text" class="form-control"
                name="layout[program][font_size]"
                value="{{ old('layout.program.font_size', $program['font_size'] ?? '') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label small">Font Weight</label>
                <select class="form-select" name="layout[program][font_weight]">
                <option value="normal" {{ old('layout.program.font_weight', $program['font_weight'] ?? '') === 'normal' ? 'selected' : '' }}>Normal</option>
                <option value="bold" {{ old('layout.program.font_weight', $program['font_weight'] ?? '') === 'bold' ? 'selected' : '' }}>Bold</option>
                </select>
            </div>
            </div>
            </fieldset>

            {{-- ================= DATE ================= --}}
            <fieldset class="border rounded p-3 mb-3">
            <legend class="float-none w-auto px-2 fs-6 fw-semibold text-muted">Tanggal</legend>

            @php $date = $layout['date'] ?? []; @endphp

            <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label small">Top</label>
                <input type="text" class="form-control"
                name="layout[date][top]"
                value="{{ old('layout.date.top', $date['top'] ?? '') }}">
            </div>

            <div class="col-md-4">
                <label class="form-label small">Left</label>
                <input type="text" class="form-control"
                name="layout[date][left]"
                value="{{ old('layout.date.left', $date['left'] ?? '') }}">
            </div>

            <div class="col-md-4">
                <label class="form-label small">Font Size</label>
                <input type="text" class="form-control"
                name="layout[date][font_size]"
                value="{{ old('layout.date.font_size', $date['font_size'] ?? '') }}">
            </div>
            </div>
            </fieldset>

            {{-- ================= CERTIFICATE NUMBER ================= --}}
            <fieldset class="border rounded p-3 mb-3">
            <legend class="float-none w-auto px-2 fs-6 fw-semibold text-muted">Nomor Sertifikat</legend>

            @php $cert = $layout['certificate_number'] ?? []; @endphp

            <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label small">Top</label>
                <input type="text" class="form-control"
                name="layout[certificate_number][top]"
                value="{{ old('layout.certificate_number.top', $cert['top'] ?? '') }}">
            </div>

            <div class="col-md-4">
                <label class="form-label small">Left</label>
                <input type="text" class="form-control"
                name="layout[certificate_number][left]"
                value="{{ old('layout.certificate_number.left', $cert['left'] ?? '') }}">
            </div>

            <div class="col-md-4">
                <label class="form-label small">Font Size</label>
                <input type="text" class="form-control"
                name="layout[certificate_number][font_size]"
                value="{{ old('layout.certificate_number.font_size', $cert['font_size'] ?? '') }}">
            </div>
            </div>
            </fieldset>

            {{-- ================= QR ================= --}}
            <fieldset class="border rounded p-3">
            <legend class="float-none w-auto px-2 fs-6 fw-semibold text-muted">QR Code</legend>

            @php $qr = $layout['qr'] ?? []; @endphp

            <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label small">Top</label>
                <input type="text" class="form-control"
                name="layout[qr][top]"
                value="{{ old('layout.qr.top', $qr['top'] ?? '') }}">
            </div>

            <div class="col-md-4">
                <label class="form-label small">Left</label>
                <input type="text" class="form-control"
                name="layout[qr][left]"
                value="{{ old('layout.qr.left', $qr['left'] ?? '') }}">
            </div>

            <div class="col-md-4">
                <label class="form-label small">Size</label>
                <input type="text" class="form-control"
                name="layout[qr][size]"
                value="{{ old('layout.qr.size', $qr['size'] ?? '') }}">
            </div>
            </div>
            </fieldset>

            <small class="text-muted d-block mt-2">
            Gunakan satuan <code>mm</code>, <code>px</code>, atau <code>%</code>
            </small>
            </div>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('admin.template-sertifikat.index') }}" class="btn btn-light">
                Batal
            </a>
            <button class="btn btn-primary">
                <i class="bi bi-arrow-repeat me-1"></i> Update
            </button>
        </div>

      </form>
    </div>
  </div>
</div>

{{-- SCRIPT PREVIEW --}}
<script>
function previewImage(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById('imagePreview').src = e.target.result;
      document.getElementById('modalImage').src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
@endsection
