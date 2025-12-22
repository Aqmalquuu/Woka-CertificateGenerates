@extends('partials.layouts.master')

@section('title', 'Admin | Update Sertifikat')
@section('title-sub', 'W-Cert')
@section('pagetitle', 'Update Sertifikat')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card courses-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Update Sertifikat</h5>
                </div>

                <form action="{{ route('admin.certificates.update', $certificate->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        {{-- SISWA (READ ONLY) --}}
                        <div class="mb-3">
                            <label class="form-label">Siswa</label>
                            <input type="text" class="form-control" value="{{ $certificate->student->user->name }}"
                                readonly>
                        </div>

                        {{-- PROGRAM --}}
                        <div class="mb-3">
                            <label class="form-label">Program</label>
                            <select name="program_id" class="form-select" required>
                                @foreach ($programs as $program)
                                    <option value="{{ $program->id }}" {{ old('program_id', $certificate->program_id) == $program->id ? 'selected' : '' }}>
                                        {{ $program->nama_program }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- TEMPLATE --}}
                        <div class="mb-3">
                            <label class="form-label">Template Sertifikat</label>
                            
                            <div class="mb-3">
                                <img id="templatePreview" src="" class="img-thumbnail"
                                    style="max-height: 200px; cursor: pointer;" data-bs-toggle="modal"
                                    data-bs-target="#templatePreviewModal">
                            </div>

                            <select name="template_id" id="templateSelect" class="form-select" required>
                                @foreach ($templates as $template)
                                    <option value="{{ $template->id }}"
                                        data-image="{{ asset('storage/' . $template->image_template) }}" {{ old('template_id', $certificate->template_id) == $template->id ? 'selected' : '' }}>
                                        {{ $template->nama_template }}
                                    </option>
                                @endforeach
                            </select>
                            
                            <div class="modal fade" id="templatePreviewModal" tabindex="-1">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body text-center">
                                            <img id="modalTemplateImage" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{-- TANGGAL TERBIT --}}
                        <div class="mb-3">
                            <label class="form-label">Tanggal Terbit</label>
                            <input type="date" name="issued_date" class="form-control"
                                value="{{ old('issued_date', $certificate->issued_date->format('Y-m-d')) }}" required>
                        </div>

                        {{-- STATUS --}}
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="active" {{ old('status', $certificate->status) == 'active' ? 'selected' : '' }}>
                                    Active
                                </option>
                                <option value="revoked" {{ old('status', $certificate->status) == 'revoked' ? 'selected' : '' }}>
                                    Revoked
                                </option>
                            </select>
                        </div>

                    </div>

                    <div class="card-footer text-end">
                        <a href="{{ route('admin.certificates.index') }}" class="btn btn-light">Batal</a>
                        <button class="btn btn-primary">
                            <i class="bi bi-arrow-repeat me-1"></i> Update
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const select = document.getElementById('templateSelect');
            const preview = document.getElementById('templatePreview');
            const modalImg = document.getElementById('modalTemplateImage');

            function updatePreview() {
                const selectedOption = select.options[select.selectedIndex];
                const imageUrl = selectedOption.getAttribute('data-image');

                if (imageUrl) {
                    preview.src = imageUrl;
                    modalImg.src = imageUrl;
                    preview.style.display = 'block';
                } else {
                    preview.style.display = 'none';
                }
            }

            select.addEventListener('change', updatePreview);

            // load pertama (edit page)
            updatePreview();
        });
    </script>

@endsection