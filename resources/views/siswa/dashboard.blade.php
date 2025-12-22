@extends('partials.layouts.master')

@section('title', 'Dashboard Siswa')
@section('pagetitle', 'Sertifikat Saya')

@section('content')

    {{-- ================= DESKTOP VIEW ================= --}}
    <div class="d-none d-md-block">
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Program</th>
                            <th class="text-center">QR</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($certifikats as $no => $sertifikat)
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>{{ $sertifikat->certificate_code }}</td>
                                <td>{{ $sertifikat->program->nama_program }}</td>

                                <td class="text-center">
                                    <img src="{{ asset('storage/' . $sertifikat->qr_code_path) }}" width="60"
                                        class="cursor-pointer" data-bs-toggle="modal"
                                        data-bs-target="#qrModal{{ $sertifikat->id }}">
                                </td>

                                <td>
                                    <span class="badge bg-{{ $sertifikat->status === 'active' ? 'success' : 'danger' }}">
                                        {{ ucfirst($sertifikat->status) }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    @if ($sertifikat->status === 'active')
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#pdfModal{{ $sertifikat->id }}">
                                            Preview
                                        </button>

                                        <button class="btn btn-sm btn-primary btn-download"
                                            data-url="{{ route('siswa.sertifikat.download', $sertifikat->id) }}">
                                            Download
                                        </button>

                                    @endif
                                </td>
                            </tr>

                            {{-- MODAL QR --}}
                            <div class="modal fade" id="qrModal{{ $sertifikat->id }}">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content text-center p-4">
                                        <h5>QR Code Sertifikat</h5>
                                        <img src="{{ asset('storage/' . $sertifikat->qr_code_path) }}" class="img-fluid mt-3">
                                    </div>
                                </div>
                            </div>

                            {{-- MODAL PDF --}}
                            <div class="modal fade" id="pdfModal{{ $sertifikat->id }}">
                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6>Preview Sertifikat</h6>
                                            <button class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-0">
                                            <iframe src="{{ route('siswa.sertifikat.preview', $sertifikat->id) }}" width="100%"
                                                height="600">
                                            </iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ================= MOBILE VIEW ================= --}}
    <div class="d-md-none">
        @foreach ($certifikats as $sertifikat)
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="fw-bold">{{ $sertifikat->program->nama_program }}</h6>
                    <small class="text-muted">{{ $sertifikat->certificate_code }}</small>

                    <div class="my-3 text-center">
                        <img src="{{ asset('storage/' . $sertifikat->qr_code_path) }}" width="120" data-bs-toggle="modal"
                            data-bs-target="#qrModal{{ $sertifikat->id }}">
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary btn-download" data-bs-toggle="modal"
                            data-bs-target="#pdfModal{{ $sertifikat->id }}">
                            Preview Sertifikat
                        </button>

                        <a href="{{ route('siswa.sertifikat.download', $sertifikat->id) }}" class="btn btn-primary">
                            Download PDF
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.querySelectorAll('.btn-download').forEach(btn => {
            btn.addEventListener('click', function () {
                const url = this.dataset.url;

                Swal.fire({
                    title: 'Download Sertifikat?',
                    text: 'Pastikan data sertifikat sudah benar',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Download',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });
    </script>

@endsection