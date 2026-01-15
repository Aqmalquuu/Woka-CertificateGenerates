@extends('partials.layouts.master')

@section('title', 'Admin | Tambah Siswa')
@section('title-sub', 'W-Certif')
@section('pagetitle', 'Tambah Siswa')

@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Form Tambah Siswa</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.student.store') }}" method="POST">
                    @csrf

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Siswa</label>
                        <input type="text"
                               name="name"
                               class="form-control @error('nama') is-invalid @enderror"
                               placeholder="Masukkan nama siswa"
                               value="{{ old('nama') }}"
                               required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="Masukkan email siswa"
                               value="{{ old('email') }}"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Masukkan password"
                               required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- NIS --}}
                    <div class="mb-3">
                        <label class="form-label">NIS</label>
                        <input type="text"
                               name="nis"
                               class="form-control @error('nis') is-invalid @enderror"
                               placeholder="Masukkan NIS"
                               value="{{ old('nis') }}"
                               required>
                        @error('nis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Asal Sekolah --}}
                    <div class="mb-4">
                        <label class="form-label">Asal Sekolah</label>
                        <input type="text"
                               name="asal_sekolah"
                               class="form-control @error('asal_sekolah') is-invalid @enderror"
                               placeholder="Contoh: SMK Negeri 1"
                               value="{{ old('asal_sekolah') }}">
                        @error('asal_sekolah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Button --}}
                    <div class="card-footer text-end">
                        <a href="{{ route('admin.student.index') }}" class="btn btn-light">
                            Batal
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
