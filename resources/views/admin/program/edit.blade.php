@extends('partials.layouts.master')

@section('title', 'Admin | Update Program')
@section('title-sub', 'W-Certif')
@section('pagetitle', 'Update Program')

@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Form Update Program</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.program.update', $program->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Program</label>
                        <input type="text"
                               name="nama_program"
                               class="form-control @error('program') is-invalid @enderror"
                               placeholder="Masukkan nama program"
                               value="{{ old('program', $program->nama_program) }}"
                               required>
                        @error('program')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis</label>
                        <select name="jenis" id="jenis" class="form-control">
                            <option value="" disabled selected>-- Pilih Jenis Program--</option>
                            <option value="kursus" {{ old('jenis', $program->jenis) == 'kursus' ? 'selected': '' }}>Kursus</option>
                            <option value="pkl" {{ old('jenis', $program->jenis) == 'pkl' ? 'selected': '' }}>PKL</option>
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
                               value="{{ old('durasi', $program->durasi) }}"
                               required>
                        @error('durasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Button --}}
                    <div class="card-footer text-end">
                        <a href="{{ route('admin.program.index') }}" class="btn btn-light">
                            Batal
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-arrow-repeat me-1"></i> Update
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
