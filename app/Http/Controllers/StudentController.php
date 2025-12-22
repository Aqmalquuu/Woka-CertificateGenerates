<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Student;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $students = Student::with('user')->paginate(10);
        return view('admin.siswa.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|string|max:50|unique:students,nis',
            'asal_sekolah' => 'nullable|string|max:255',

            // user
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',

        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
        ]);

        Student::create([
            'user_id' => $user->id,
            'nis' => $request->nis,
            'asal_sekolah' => $request->asal_sekolah,
        ]);

        return redirect()->route('admin.student.index')->with('success', 'Siswa dan akun berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
        return view('admin.siswa.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
        $user = User::findOrFail($student->user_id);
        $request->validate([
            'nis' => 'required|string|max:50|unique:students,nis,' . $student->id,
            'asal_sekolah' => 'nullable|string|max:255',

            // user
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $user->password 
        ]);

        $student->update([
            'nis' => $request->nis,
            'asal_sekolah' => $request->asal_sekolah
        ]);

        return redirect()->route('admin.student.index')->with('success', 'Siswa dan akun berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
        $user = User::find($student->user_id);
        $certificate = Certificate::where('student_id', $student->id)->first();

        if ($certificate->pdf_path) {
            $pdfPath = str_replace('storage/', '', $certificate->pdf_path);
            Storage::disk('public')->delete($pdfPath);
        }

        if ($certificate->qr_code_path) {
            $qrPath = str_replace('storage/', '', $certificate->qr_code_path);
            Storage::disk('public')->delete($qrPath);
        }
        
        $student->delete();
        $user->delete();

        return redirect()->back()->with('success', 'Siswa, akun dan sertifikat berhasil dihapus');
    }
}
