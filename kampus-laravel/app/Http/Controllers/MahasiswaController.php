<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    /**
     * Tampilkan semua data mahasiswa (READ)
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::orderBy('id', 'desc')->get();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * Tampilkan form tambah data (CREATE FORM)
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Simpan data baru ke database (CREATE ACTION)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim|min:4',
            'nama' => 'required',
            'prodi' => 'required',
        ], [
            'nim.required' => 'NIM wajib diisi.',
            'nim.unique' => 'NIM sudah digunakan.',
            'nim.min' => 'NIM minimal 4 karakter.',
            'nama.required' => 'Nama wajib diisi.',
            'prodi.required' => 'Program Studi wajib diisi.',
        ]);

        Mahasiswa::create($request->only('nim', 'nama', 'prodi'));

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa disimpan.');
    }

    /**
     * Tampilkan form edit data (UPDATE FORM)
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Proses update data ke database (UPDATE ACTION)
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required|min:4|unique:mahasiswa,nim,' . $mahasiswa->id,
            'nama' => 'required',
            'prodi' => 'required'
        ], [
            'nim.required' => 'NIM wajib diisi.',
            'nim.unique' => 'NIM sudah digunakan.',
            'nim.min' => 'NIM minimal 4 karakter.',
            'nama.required' => 'Nama wajib diisi.',
            'prodi.required' => 'Program Studi wajib diisi.',
        ]);

        $mahasiswa->update($request->only('nim', 'nama', 'prodi'));

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa diperbarui.');
    }

    /**
     * Hapus data mahasiswa (DELETE)
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

    
        DB::statement("DELETE FROM sqlite_sequence WHERE name='mahasiswa'");

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
