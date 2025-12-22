@extends('partials.layouts.master')

@section('title', 'Admin | Manajemen Siswa')
@section('title-sub', 'W-Cert')
@section('pagetitle', 'Manajemen Siswa')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow-sm border-0">
            {{-- Header --}}
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-semibold">Daftar Siswa</h5>
                    <small class="text-muted">Data siswa terdaftar dalam sistem</small>
                </div>

                <a href="{{ route('admin.student.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Siswa
                </a>
            </div>

            {{-- Body --}}
            <div class="card-body p-0">
                <div class="table-responsive px-3 pt-3">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-uppercase small">
                            <tr>
                                <th width="50">No</th>
                                <th>Nama Siswa</th>
                                <th>NIS</th>
                                <th>Asal Sekolah</th>
                                <th class="text-center" width="160">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($students as $no => $student)
                                <tr>
                                    <td class="text-muted">
                                        {{ $students->firstItem() + $no }}
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <div class="fw-semibold text-muted">{{ $student->user->name }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="badge bg-light text-dark">
                                            {{ $student->nis }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="fw-semibold text-muted">{{ $student->asal_sekolah ?? '-' }}</div>
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('admin.student.edit', $student->id) }}" class="btn btn-sm btn-outline-warning me-1">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form action="{{ route('admin.student.destroy', $student->id) }}" method="POST" class="d-inline form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="text-center py-5">
                                            <i class="bi bi-people fs-1 text-muted"></i>
                                            <p class="mt-3 mb-1 fw-semibold">Belum ada data siswa</p>
                                            <small class="text-muted">
                                                Silakan tambahkan siswa baru untuk memulai
                                            </small>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Footer --}}
                <div class="d-flex justify-content-between align-items-center px-4 py-3 border-top">
                    <div class="text-muted small">
                        Menampilkan
                        {{ $students->firstItem() ?? 0 }}
                        -
                        {{ $students->lastItem() ?? 0 }}
                        dari
                        {{ $students->total() }} data
                    </div>

                    <div>
                        {{ $students->links('pagination::bootstrap-5') }}
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
                        text: 'Data siswa yang dihapus tidak bisa dikembalikan!',
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
