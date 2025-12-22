@extends('partials.layouts.master')

@section('title', 'Admin | Template Sertifikat')
@section('title-sub', 'W-Cert')
@section('pagetitle', 'Template Sertifikat')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card courses-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Daftar Template Sertifikat</h5>

                <a href="{{ route('admin.template-sertifikat.create') }}"
                    class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Template
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="50">No</th>
                                <th>Nama Template</th>
                                <th class="text-center">Template</th>
                                <th class="text-center" width="150">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($templates as $index => $template)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="fw-semibold">{{ $template->nama_template }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset('storage/'.$template->image_template) }}"
                                            height="60" class="rounded shadow-sm">
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.template-sertifikat.edit', $template->id) }}"
                                            class="btn btn-sm btn-outline-warning me-1">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form action="{{ route('admin.template-sertifikat.destroy', $template->id) }}"
                                            method="POST" class="d-inline form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        Template belum tersedia
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
