@extends('partials.layouts.master')

@section('title', 'Admin | Generate Sertifikat')
@section('title-sub', 'W-Certif')
@section('pagetitle', 'Generate Sertifikat')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card courses-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Generate Sertifikat</h5>
                </div>

                <form action="{{ route('admin.certificates.store') }}" method="POST">
                    @csrf

                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Siswa</label>
                            <select name="student_id" class="form-select" required>
                                <option value="">-- Pilih Siswa --</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">
                                        {{ $student->user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Program</label>
                            <select name="program_id" class="form-select" required>
                                <option value="">-- Pilih Program --</option>
                                @foreach ($programs as $program)
                                    <option value="{{ $program->id }}">
                                        {{ $program->nama_program }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Template Sertifikat</label>
                            <select name="template_id" class="form-select" required>
                                <option value="">-- Pilih Template --</option>
                                @foreach ($templates as $template)
                                    <option value="{{ $template->id }}">
                                        {{ $template->nama_template }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Terbit</label>
                            <input type="date" name="issued_date" class="form-control" value="{{ now()->toDateString() }}"
                                required>
                        </div>

                    </div>

                    <div class="card-footer text-end">
                        <a href="{{ route('admin.certificates.index') }}" class="btn btn-light">Batal</a>
                        <button class="btn btn-primary">
                            <i class="bi bi-award me-1"></i> Generate
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection