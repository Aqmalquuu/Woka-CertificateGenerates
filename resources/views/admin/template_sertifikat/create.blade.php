@extends('partials.layouts.master')

@section('title', 'Admin | Tambah Template Sertifikat')
@section('title-sub', 'W-Certif')
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

            {{-- NAMA TEMPLATE --}}
            <div class="mb-4">
              <label class="form-label fw-semibold mb-1">Nama Template</label>
              <input type="text" name="nama_template" class="form-control" required>
            </div>

            {{-- BACKGROUND --}}
            <div class="mb-4">
              <label class="form-label fw-semibold mb-1">Background Sertifikat</label>
              {{-- PREVIEW --}}
              <div class="mt-3">
                <img id="backgroundPreview" src="" alt="Preview Background" class="img-fluid d-none"
                  style="max-height: 200px;">
              </div>
              <input type="file" name="image_template" class="form-control" accept="image/*" required
                onchange="previewBackground(event)">
            </div>

            {{-- ================= LAYOUT ================= --}}
            <div class="mb-2">
              <label class="form-label fw-bold mb-2">Layout Sertifikat</label>

              {{-- ================= STUDENT NAME ================= --}}
              <fieldset class="border rounded p-3 mb-3">
                <legend class="float-none w-auto px-2 fs-6 fw-semibold text-muted">
                  Nama Siswa
                </legend>

                <div class="row g-3">
                  <div class="col-md-3">
                    <label class="form-label small">Top</label>
                    <input type="text" class="form-control" name="layout[student_name][top]">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small">Left</label>
                    <input type="text" class="form-control" name="layout[student_name][left]">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small">Font Size</label>
                    <input type="text" class="form-control" name="layout[student_name][font_size]">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small">Font Family</label>
                    <select class="form-select" name="layout[student_name][font_family]">
                      <option value="">-- Pilih Font --</option>
                      <option value="Times New Roman">Times New Roman</option>
                      <option value="Georgia">Georgia</option>
                      <option value="Garamond">Garamond</option>
                      <option value="Playfair Display">Playfair Display</option>
                      <option value="Libre Baskerville">Libre Baskerville</option>
                      <option value="Cinzel">Cinzel</option>
                      <option value="Trajan Pro">Trajan Pro</option>
                      <option value="GreatVibes">Great Vibes</option>
                    </select>
                  </div>

                  <div class="col-md-3">
                    <label class="form-label small">Font Weight</label>
                    <select class="form-select" name="layout[student_name][font_weight]">
                      <option value="normal" selected>Normal</option>
                      <option value="bold">Bold</option>
                    </select>
                  </div>
                </div>
              </fieldset>

              {{-- ================= SUPPORTING TEXT ================= --}}
              <fieldset class="border rounded p-3 mb-3">
                <legend class="float-none w-auto px-2 fs-6 fw-semibold text-muted">
                  Supporting Text
                </legend>

                <div class="row g-3">
                  <div class="col-md-3">
                    <label class="form-label small">Top</label>
                    <input type="text" class="form-control" name="layout[supporting_text][top]">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small">Left</label>
                    <input type="text" class="form-control" name="layout[supporting_text][left]">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small">Width</label>
                    <input type="text" class="form-control" name="layout[supporting_text][width]">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small">Font Size</label>
                    <input type="text" class="form-control" name="layout[supporting_text][font_size]">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small">Text Align</label>
                    <select class="form-select" name="layout[supporting_text][text_align]">
                      <option value="left" selected>Left</option>
                      <option value="center">Center</option>
                      <option value="right">Right</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small">Line Height</label>
                    <input type="text" class="form-control" name="layout[supporting_text][line_height]">
                  </div>
                </div>
              </fieldset>

              {{-- ================= PROGRAM ================= --}}
              <fieldset class="border rounded p-3 mb-3">
                <legend class="float-none w-auto px-2 fs-6 fw-semibold text-muted">
                  Program
                </legend>

                <div class="row g-3">
                  <div class="col-md-3">
                    <label class="form-label small">Top</label>
                    <input type="text" class="form-control" name="layout[program][top]">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small">Left</label>
                    <input type="text" class="form-control" name="layout[program][left]">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small">Font Size</label>
                    <input type="text" class="form-control" name="layout[program][font_size]">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small">Font Weight</label>
                    <select class="form-select" name="layout[program][font_weight]">
                      <option value="normal">Normal</option>
                      <option value="bold" selected>Bold</option>
                    </select>
                  </div>
                </div>
              </fieldset>

              {{-- ================= DATE ================= --}}
              <fieldset class="border rounded p-3 mb-3">
                <legend class="float-none w-auto px-2 fs-6 fw-semibold text-muted">
                  Tanggal
                </legend>

                <div class="row g-3">
                  <div class="col-md-4">
                    <label class="form-label small">Top</label>
                    <input type="text" class="form-control" name="layout[date][top]">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label small">Left</label>
                    <input type="text" class="form-control" name="layout[date][left]">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label small">Font Size</label>
                    <input type="text" class="form-control" name="layout[date][font_size]">
                  </div>
                </div>
              </fieldset>

              {{-- ================= CERTIFICATE NUMBER ================= --}}
              <fieldset class="border rounded p-3 mb-3">
                <legend class="float-none w-auto px-2 fs-6 fw-semibold text-muted">
                  Nomor Sertifikat
                </legend>

                <div class="row g-3">
                  <div class="col-md-4">
                    <label class="form-label small">Top</label>
                    <input type="text" class="form-control" name="layout[certificate_number][top]">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label small">Left</label>
                    <input type="text" class="form-control" name="layout[certificate_number][left]">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label small">Font Size</label>
                    <input type="text" class="form-control" name="layout[certificate_number][font_size]"
                     >
                  </div>
                </div>
              </fieldset>

              {{-- ================= QR ================= --}}
              <fieldset class="border rounded p-3">
                <legend class="float-none w-auto px-2 fs-6 fw-semibold text-muted">
                  QR Code
                </legend>

                <div class="row g-3">
                  <div class="col-md-4">
                    <label class="form-label small">Top</label>
                    <input type="text" class="form-control" name="layout[qr][top]">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label small">Left</label>
                    <input type="text" class="form-control" name="layout[qr][left]">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label small">Size</label>
                    <input type="text" class="form-control" name="layout[qr][size]">
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
              <i class="bi bi-save me-1"></i> Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    function previewBackground(event) {
      const input = event.target;
      const previewImg = document.getElementById('backgroundPreview');
      const previewText = document.getElementById('previewText');

      if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
          previewImg.src = e.target.result;
          previewImg.classList.remove('d-none');
          previewText.classList.add('d-none');
        };

        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>

@endsection