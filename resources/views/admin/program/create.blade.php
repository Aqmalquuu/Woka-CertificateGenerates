@extends('partials.layouts.master')

@section('title', 'Adamin | Tambah Program')
@section('title-sub', 'W-Cert')
@section('pagetitle', 'Tambah Program')

@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Form Tambah Program</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.program.store') }}" method="POST">
                    @csrf

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Program</label>
                        <input type="text"
                               name="nama_program"
                               class="form-control @error('program') is-invalid @enderror"
                               placeholder="Masukkan nama program"
                               value="{{ old('program') }}"
                               required>
                        @error('program')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis</label>
                        <select name="jenis" id="jenis" class="form-control">
                            <option value="" disabled selected>-- Pilih Jenis Program--</option>
                            <option value="kursus">Kursus</option>
                            <option value="pkl">PKL</option>
                        </select>
                        @error('jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Durasi</label>
                        <input type="text"
                               name="durasi"
                               class="form-control @error('durasi') is-invalid @enderror"
                               placeholder="Masukkan durasi"
                               value="{{ old('durasi') }}"
                               required>
                        @error('durasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Button --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.student.index') }}" class="btn btn-light">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Simpan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
