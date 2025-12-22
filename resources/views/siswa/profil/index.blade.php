@extends('partials.layouts.master')

@section('title', 'Profil Siswa')
@section('pagetitle', 'Profil Saya')

@section('content')

    <div class="row">
        <div class="col-lg-4">
            {{-- CARD PROFIL --}}
            <div class="card text-center">
                <div class="card-body">
                    <div class="rounded-circle bg-primary text-white dark:bg-secondary dark:text-light d-flex justify-content-center align-items-center me-2 shadow-sm"
                        style="width: 150px; height: 150px; font-size: 50px; font-weight: bold;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                    <small class="text-muted">{{ Auth::user()->email }}</small>

                    <span class="badge bg-success mt-2">Siswa</span>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            {{-- DETAIL PROFIL --}}
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Pribadi</h5>
                </div>

                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th width="180">Nama Lengkap</th>
                            <td>{{ Auth::user()->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>
                        <tr>
                            <th>Nis</th>
                            <td>{{ Auth::user()->student->nis ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Asal Sekolah</th>
                            <td>{{ Auth::user()->student->asal_sekolah ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Daftar</th>
                            <td>{{ Auth::user()->created_at->format('d M Y') }}</td>
                        </tr>
                    </table>
                </div>

                <div class="card-footer text-end">
                    <a href="#" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-pencil-square me-1"></i> Edit Profil
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection