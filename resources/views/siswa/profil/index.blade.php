@extends('partials.layouts.master')

@section('title', 'Profil Siswa')
@section('pagetitle', 'Profil Saya')

@section('content')
<div class="row g-4">
    <!-- Card Profil (Foto & Identitas Singkat) -->
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
            <div class="card-body text-center py-5">
                <div class="position-relative d-inline-block mb-4">
                    <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center shadow"
                         style="width: 140px; height: 140px; font-size: 48px; font-weight: bold;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="position-absolute bottom-1 start-50 translate-middle badge rounded-pill bg-success px-4 py-2">
                        {{ ucfirst(Auth::user()->role ?? 'Siswa') }}
                    </span>
                </div>

                <h5 class="fw-bold mb-1">{{ Auth::user()->name }}</h5>
                <p class="text-muted mb-0 small">{{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>

    <!-- Detail Profil -->
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-3 h-100">
            <div class="card-header bg-light py-3">
                <h5 class="mb-0 fw-semibold text-dark">Informasi Pribadi</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex align-items-center">
                        <i class="bi bi-person-circle me-3 text-primary fs-5"></i>
                        <div>
                            <small class="text-muted">Nama Lengkap</small><br>
                            <strong>{{ Auth::user()->name }}</strong>
                        </div>
                    </li>
                    <li class="list-group-item d-flex align-items-center">
                        <i class="bi bi-envelope me-3 text-primary fs-5"></i>
                        <div>
                            <small class="text-muted">Email</small><br>
                            {{ Auth::user()->email }}
                        </div>
                    </li>
                    <li class="list-group-item d-flex align-items-center">
                        <i class="bi bi-qr-code me-3 text-primary fs-5"></i>
                        <div>
                            <small class="text-muted">NIS</small><br>
                            {{ Auth::user()->student?->nis ?? '-' }}
                        </div>
                    </li>
                    <li class="list-group-item d-flex align-items-center">
                        <i class="bi bi-building me-3 text-primary fs-5"></i>
                        <div>
                            <small class="text-muted">Asal Sekolah</small><br>
                            {{ Auth::user()->student?->asal_sekolah ?? '-' }}
                        </div>
                    </li>
                    <li class="list-group-item d-flex align-items-center">
                        <i class="bi bi-calendar-check me-3 text-primary fs-5"></i>
                        <div>
                            <small class="text-muted">Tanggal Daftar</small><br>
                            {{ Auth::user()->created_at->format('d M Y') }}
                        </div>
                    </li>
                </ul>
            </div>
            <div class="card-footer bg-white border-0 text-end py-3">
                <a href="#" class="btn btn-primary btn-sm px-4">
                    <i class="bi bi-pencil-square me-1"></i> Edit Profil
                </a>
            </div>
        </div>
    </div>
</div>
@endsection