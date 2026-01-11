<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {

            $totalSiswa = User::where('role', 'siswa')->count();
            $totalProgram = Program::count();
            $totalSertifikat = Certificate::count();
            $totalSertifikatAktif = Certificate::where('status', 'active')->count();
            $totalSertifikatDicabut = Certificate::where('status', 'revoked')->count();

            $certifikats = Certificate::with('student.user')
                ->orderBy('id', 'desc')
                ->paginate(10);
            return view('admin.dashboard', compact([
                'totalSiswa',
                'totalProgram',
                'totalSertifikat',
                'totalSertifikatAktif',
                'totalSertifikatDicabut',
                'certifikats'
            ]));
        } elseif ($user->role === 'siswa') {
            // Ambil sertifikat milik siswa yang login
            $certifikats = Certificate::with(['program'])
                ->whereHas('student', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                })
                ->latest()
                ->get();

            return view('siswa.dashboard', compact('certifikats'));
        } else {
            abort(403, 'Role pengguna tidak dikenal!');
        }
    }

    public function download($id)
    {
        $certificate = Certificate::where('id', $id)
            ->whereHas('student', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->where('status', 'active')
            ->firstOrFail();

        return Storage::disk('public')->download($certificate->pdf_path);
    }

    public function preview($id)
    {
        $certificate = Certificate::where('id', $id)
            ->whereHas('student', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->where('status', 'active')
            ->firstOrFail();

        return response()->file(
            storage_path('app/public/' . $certificate->pdf_path)
        );
    }
}
