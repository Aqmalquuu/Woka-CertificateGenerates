@extends('partials.layouts.master')

@section('title', 'WokaCert | Dashboard Admin')
@section('title-sub', 'W-Certif')
@section('pagetitle', 'Dashboard')
@section('content')

    <!-- begin::App -->
    <div id="layout-wrapper">

        <div class="row">
            <div class="col-xxl col-sm-6">
                <div class="card overflow-hidden">
                    <div class="card-body position-relative z-1">
                        <div class="d-flex gap-2 justify-content-between">
                            <div>
                                <span class="d-block mb-5">Total Siswa</span>
                                <h4 class="mb-4 fw-semibold">{{ $totalSiswa }}</h4>
                            </div>
                            <div
                                class="h-50px w-50px d-flex justify-content-center align-items-center bg-info rounded-pill text-white fs-4">
                                <i class="bi bi-mortarboard-fill"></i>
                            </div>
                        </div>
                    </div>
                    <img src="{{ asset('assets/images/dashboard/academy-bg1.png') }}" alt="Academy Image"
                        class="position-absolute bottom-0 right  h-100 w-100 object-fit-cover  opacity-5">
                </div>
            </div>
            <div class="col-xxl col-sm-6">
                <div class="card overflow-hidden">
                    <div class="card-body position-relative z-1">
                        <div class="d-flex gap-2 justify-content-between">
                            <div>
                                <span class="d-block mb-5">Total Program</span>
                                <h4 class="mb-4 fw-semibold">{{ $totalProgram }}</h4>
                            </div>
                            <div
                                class="h-50px w-50px d-flex justify-content-center align-items-center bg-primary rounded-pill text-white fs-4">
                                <i class="ri-presentation-line"></i>
                            </div>
                        </div>
                    </div>
                    <img src="{{ asset('assets/images/dashboard/academy-bg3.png') }}" alt="Academy Image"
                        class="position-absolute bottom-0 right  h-100 w-100 object-fit-cover  opacity-5">
                </div>
            </div>
            <div class="col-xxl col-sm-6">
                <div class="card overflow-hidden">
                    <div class="card-body position-relative z-1">
                        <div class="d-flex gap-2 justify-content-between">
                            <div>
                                <span class="d-block mb-5">Total Sertifikat</span>
                                <h4 class="mb-4 fw-semibold">{{ $totalSertifikat }}</h4>
                            </div>
                            <div
                                class="h-50px w-50px d-flex justify-content-center align-items-center bg-secondary rounded-pill text-white fs-4">
                                <i class="bi bi-file-earmark-check-fill"></i>
                            </div>
                        </div>
                    </div>
                    <img src="{{ asset('assets/images/dashboard/academy-bg2.png') }}" alt="Academy Image"
                        class="position-absolute bottom-0 right  h-100 w-100 object-fit-cover  opacity-5">
                </div>
            </div>
            <div class="col-xxl col-sm-6">
                <div class="card overflow-hidden">
                    <div class="card-body position-relative z-1">
                        <div class="d-flex gap-2 justify-content-between">
                            <div>
                                <span class="d-block mb-5">Sertifikat Aktif</span>
                                <h4 class="mb-4 fw-semibold">{{ $totalSertifikatAktif }}</h4>
                            </div>
                            <div
                                class="h-50px w-50px d-flex justify-content-center align-items-center bg-success rounded-pill text-white fs-4">
                                <i class="bi bi-award-fill"></i>
                            </div>
                        </div>
                    </div>
                    <img src="{{ asset('assets/images/dashboard/academy-bg4.png') }}" alt="Academy Image"
                        class="position-absolute bottom-0 right  h-100 w-100 object-fit-cover  opacity-5">
                </div>
            </div>
            <div class="col-xxl col-sm-6">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex gap-2 justify-content-between">
                            <div>
                                <span class="d-block mb-5">Sertifikat Dicabut</span>
                                <h4 class="mb-4 fw-semibold">{{ $totalSertifikatDicabut }}</h4>
                            </div>
                            <div
                                class="h-50px w-50px d-flex justify-content-center align-items-center bg-danger rounded-pill text-white fs-4">
                                <i class="bi bi-award-fill"></i>
                            </div>
                        </div>
                    </div>
                    <img src="{{ asset('assets/images/dashboard/academy-bg5.png') }}" alt="Academy Image"
                        class="position-absolute bottom-0 right  h-100 w-100 object-fit-cover  opacity-5">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card courses-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">All Courses</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive px-3 pt-3">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light text-uppercase small">
                                    <tr>
                                        <th width="50">No</th>
                                        <th>Code Sertifikat</th>
                                        <th>Nama Siswa</th>
                                        <th>Program</th>
                                        <th>Asal Sekolah</th>
                                        <th class="text-center" width="160">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($certifikats as $no => $sertifikat)
                                        <tr>
                                            <td class="text-muted">
                                                {{ $certifikats->firstItem() + $no }}
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <div class="fw-semibold text-muted">{{ $sertifikat->certificate_code }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <div class="fw-semibold text-muted">{{ $sertifikat->student->user->name }}</div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <span class="badge bg-light text-dark">
                                                    {{ $sertifikat->Program->nama_program }}
                                                </span>
                                            </td>

                                            <td>
                                                <div class="fw-semibold text-muted">{{ $sertifikat->student->asal_sekolah ?? '-' }}</div>
                                            </td>

                                            <td class="text-center">
                                                <a href="{{ route('admin.certificates.show', $sertifikat->id) }}" class="btn btn-sm btn-outline-secondary me-1 px-3">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">
                                                <div class="text-center py-5">
                                                    <i class="ri-award-line fs-1 text-muted"></i>
                                                    <p class="mt-3 mb-1 fw-semibold">Belum ada data Sertifikat</p>
                                                    <small class="text-muted">
                                                        Silakan tambahkan Sertifikat baru untuk memulai
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
                                {{ $certifikats->firstItem() ?? 0 }}
                                -
                                {{ $certifikats->lastItem() ?? 0 }}
                                dari
                                {{ $certifikats->total() }} data
                            </div>

                            <div>
                                {{ $certifikats->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--End container-fluid-->
    </main><!--End app-wrapper-->

@endsection

@section('js')
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ asset('assets/js/dashboard/academy.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection