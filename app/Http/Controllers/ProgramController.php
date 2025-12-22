<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use function PHPUnit\Framework\returnValueMap;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $programs = Program::paginate(10);
        return view('admin.program.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.program.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama_program' => 'required|string',
            'jenis' => 'required|in:kursus,pkl',
            'durasi' => 'required|string'
        ]);

        Program::create([
            'nama_program' => $request->nama_program,
            'jenis' => $request->jenis,
            'durasi' => $request->durasi
        ]);
        return redirect()->route('admin.program.index')->with('success', 'Program berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        //
        return view('admin.program.edit', compact('program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        //
        $request->validate([
            'nama_program' => 'required|string',
            'jenis' => 'required|in:kursus,pkl',
            'durasi' => 'required|string'
        ]);

        $program->update([
            'nama_program' => $request->nama_program,
            'jenis' => $request->jenis,
            'durasi' => $request->durasi
        ]);

        return redirect()->route('admin.program.index')->with('success', 'Program berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        //
        $program->delete();
        return redirect()->back()->with('seccess', 'Program berhasil dihapus');
    }
}
