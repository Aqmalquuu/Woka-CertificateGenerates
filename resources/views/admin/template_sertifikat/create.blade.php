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

            <div class="mb-4">
              <label class="form-label fw-semibold mb-1">Nama Template</label>
              <input type="text" name="nama_template" class="form-control  @error('nama_template') is-invalid @enderror" required>
              @error('nama_template')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label class="form-label fw-semibold mb-1">Background Sertifikat</label>
              <div class="mt-3">
                <img id="backgroundPreview" src="" alt="Preview Background" class="img-fluid d-none"
                  style="max-height: 200px;">
              </div>
              <input type="file" name="image_template" class="form-control @error('image_template') is-invalid @enderror" accept="image/*" required
                onchange="previewBackground(event)">
              @error('image_template')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- ================= LAYOUT ================= --}}
            <div class="mb-2">
              <label class="form-label fw-bold mb-2">Layouts Sertifikat</label>

              <fieldset class="border rounded p-3 mb-3">
                <legend class="float-none w-auto px-2 fs-6 fw-semibold text-muted">
                  Nama Siswa
                </legend>

                <div class="row g-3">
                  <div class="col-md-3">
                    <label class="form-label small">Top</label>
                    <input type="text" class="form-control" name="layout_json[student_name][top]" required>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small">Left</label>
                    <input type="text" class="form-control" name="layout_json[student_name][left]" required>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small">Font Size</label>
                    <input type="text" class="form-control" name="layout_json[student_name][font_size]" required>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small">Font Family</label>
                    <select class="form-select" name="layout_json[student_name][font_family]" required>
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
                    <select class="form-select" name="layout_json[student_name][font_weight]" required>
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
                    <input type="text" class="form-control" name="layout_json[supporting_text][top]" required>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small">Left</label>
                    <input type="text" class="form-control" name="layout_json[supporting_text][left]" required>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small">Width</label>
                    <input type="text" class="form-control" name="layout_json[supporting_text][width]" required>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small">Font Size</label>
                    <input type="text" class="form-control" name="layout_json[supporting_text][font_size]" required>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small">Text Align</label>
                    <select class="form-select" name="layout_json[supporting_text][text_align]" required>
                      <option value="left" selected>Left</option>
                      <option value="center">Center</option>
                      <option value="right">Right</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small">Line Height</label>
                    <input type="text" class="form-control" name="layout_json[supporting_text][line_height]" required>
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
                    <input type="text" class="form-control" name="layout_json[program][top]" required>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small">Left</label>
                    <input type="text" class="form-control" name="layout_json[program][left]" required>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small">Font Size</label>
                    <input type="text" class="form-control" name="layout_json[program][font_size]" required>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small">Font Weight</label>
                    <select class="form-select" name="layout_json[program][font_weight]" required>
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
                    <input type="text" class="form-control" name="layout_json[date][top]" required>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label small">Left</label>
                    <input type="text" class="form-control" name="layout_json[date][left]" required>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label small">Font Size</label>
                    <input type="text" class="form-control" name="layout_json[date][font_size]" required>
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
                    <input type="text" class="form-control" name="layout_json[certificate_number][top]" required>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label small">Left</label>
                    <input type="text" class="form-control" name="layout_json[certificate_number][left]" required>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label small">Font Size</label>
                    <input type="text" class="form-control" name="layout_json[certificate_number][font_size]" required
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
                    <input type="text" class="form-control" name="layout_json[qr][top]" required>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label small">Left</label>
                    <input type="text" class="form-control" name="layout_json[qr][left]" required>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label small">Size</label>
                    <input type="text" class="form-control" name="layout_json[qr][size]" required>
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