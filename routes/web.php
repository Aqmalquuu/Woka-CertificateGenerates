<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CertificateTemplateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\StudentController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'Login'])->name('login.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('student', StudentController::class);
    Route::resource('program', ProgramController::class);
    Route::resource('template-sertifikat', CertificateTemplateController::class)->parameters(['template-sertifikat' => 'certificateTemplate']);
    Route::resource('certificates', CertificateController::class);
});

Route::prefix('siswa')->name('siswa.')->middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/sertifikat/download/{id}', [DashboardController::class, 'download'])->name('sertifikat.download');
    Route::get('/sertifikat/preview/{id}', [DashboardController::class, 'preview'])->name('sertifikat.preview');
    Route::get('/siswa/profil', function () {
        return view('siswa.profil.index');
    })->name('profil');

});

Route::get('/verify/{code}', function ($code) {
    $certificate = \App\Models\Certificate::where('certificate_code', $code)->firstOrFail();

    $certificate->update(['verified_at' => now()]);

    return view('verify', compact('certificate'));
})->name('certificate.verify');
