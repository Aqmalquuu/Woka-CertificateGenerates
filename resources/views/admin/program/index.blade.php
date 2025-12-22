@extends('partials.layouts.master')

@section('title', 'Admin | Manajemen Program')
@section('title-sub', 'W-Cert')
@section('pagetitle', 'Manajemen Program')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card courses-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Daftar Program</h5>

                    <a href="{{ route('admin.program.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Program
                    </a>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive px-3 pt-3">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-uppercase small">
                                <tr>
                                    <th width="50">No</th>
                                    <th>Nama Program</th>
                                    <th>Jenis</th>
                                    <th>Durasi</th>
                                    <th class="text-center" width="160">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($programs as $no => $program)
                                    <tr>
                                        <td class="text-center">
                                            <div class="fw-semibold text-dark">{{ $programs->firstItem() + $no }}</div>
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-dark">{{ $program->nama_program }}</div>
                                        </td>
                                        <td>
                                            <span class="badge {{ $program->jenis == 'kursus' ? 'bg-info' : 'bg-warning' }}">
                                                {{ strtoupper($program->jenis) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-dark">{{ $program->durasi }}</div>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.program.edit', $program->id) }}" class="btn btn-sm btn-outline-warning me-1">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form action="{{ route('admin.program.destroy', $program->id) }}" method="POST" class="d-inline form-delete">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            Data program belum tersedia
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center px-4 py-3">
                        <div class="text-muted">
                            Menampilkan
                            {{ $programs->firstItem() ?? 0 }}
                            -
                            {{ $programs->lastItem() ?? 0 }}
                            dari
                            {{ $programs->total() }} data
                        </div>

                        <div>
                            {{ $programs->links('pagination::bootstrap-5') }}
                        </div>
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
                        text: 'Data program yang dihapus tidak bisa dikembalikan!',
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