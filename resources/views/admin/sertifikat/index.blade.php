@extends('partials.layouts.master')

@section('title', 'Admin | Sertifikat')
@section('title-sub', 'W-Cert')
@section('pagetitle', 'Data Sertifikat')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card courses-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Daftar Sertifikat</h5>

                    <a href="{{ route('admin.certificates.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Generate Sertifikat
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Sertifikat</th>
                                    <th>Siswa</th>
                                    <th>Program</th>
                                    <th>Tanggal Terbit</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($certificates as $key => $certificate)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td class="fw-semibold">{{ $certificate->certificate_code }}</td>
                                        <td>{{ $certificate->student->user->name }}</td>
                                        <td>{{ $certificate->program->nama_program }}</td>
                                        <td>{{ \Carbon\Carbon::parse($certificate->issued_date)->format('d M Y') }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $certificate->status == 'active' ? 'success' : 'danger' }}">
                                                {{ ucfirst($certificate->status) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-sm" data-bs-toggle="dropdown">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>

                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <!-- View -->
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.certificates.show', $certificate->id) }}">
                                                            <i class="bi bi-eye"></i> Preview PDF
                                                        </a>
                                                    </li>

                                                    <!-- Edit -->
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.certificates.edit', $certificate->id) }}">
                                                            <i class="bi bi-pencil-square me-2"></i> Edit
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>

                                                    <!-- Delete -->
                                                    <li>
                                                        <form
                                                            action="{{ route('admin.certificates.destroy', $certificate->id) }}"
                                                            method="POST" class="form-delete">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit" class="dropdown-item text-danger">
                                                                <i class="bi bi-trash me-2"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            Sertifikat belum tersedia
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.form-delete').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: 'Data sertifikat yang dihapus tidak bisa dikembalikan!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

@endsection