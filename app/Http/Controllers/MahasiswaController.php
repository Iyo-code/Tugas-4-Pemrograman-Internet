<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    /**
     * Tampilkan semua data mahasiswa + fitur pencarian + filter fakultas/prodi
     */
    public function index(Request $request)
    {
        $keyword = $request->input('search');
        $fakultas_id = $request->input('fakultas_id');
        $prodi_id = $request->input('prodi_id');

        $query = Mahasiswa::with('prodi.fakultas');

        // Filter pencarian umum (nama, nim)
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('nama', 'like', "%{$keyword}%")
                  ->orWhere('nim', 'like', "%{$keyword}%");
            });
        }

        // Filter berdasarkan fakultas
        if ($fakultas_id) {
            $query->whereHas('prodi.fakultas', function ($q) use ($fakultas_id) {
                $q->where('id', $fakultas_id);
            });
        }

        // Filter berdasarkan prodi
        if ($prodi_id) {
            $query->where('prodi_id', $prodi_id);
        }

        $mahasiswa = $query->orderBy('id', 'asc')->get();
        $fakultas = Fakultas::orderBy('nama_fakultas')->get();
        $prodi = Prodi::orderBy('nama_prodi')->get();

        return view('index', compact('mahasiswa', 'keyword', 'fakultas', 'prodi'));
    }

    /**
     * Tampilkan form tambah data (CREATE FORM)
     */
    public function create()
    {
        $fakultas = Fakultas::all();
        return view('create', compact('fakultas'));
    }

    /**
     * Simpan data baru (CREATE ACTION)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim|min:4',
            'nama' => 'required',
            'prodi_id' => 'required|exists:prodi,id',
        ], [
            'nim.required' => 'NIM wajib diisi.',
            'nim.unique' => 'NIM sudah digunakan.',
            'nim.min' => 'NIM minimal 4 karakter.',
            'nama.required' => 'Nama wajib diisi.',
            'prodi_id.required' => 'Program Studi wajib diisi.',
        ]);

        Mahasiswa::create($request->only('nim', 'nama', 'prodi_id'));

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil disimpan.');
    }

    /**
     * Tampilkan form edit data
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $fakultas = Fakultas::all();
        return view('edit', compact('mahasiswa', 'fakultas'));
    }

    /**
     * Update data mahasiswa
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required|min:4|unique:mahasiswa,nim,' . $mahasiswa->id,
            'nama' => 'required',
            'prodi_id' => 'required|exists:prodi,id'
        ]);

        $mahasiswa->update($request->only('nim', 'nama', 'prodi_id'));

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    /**
     * Hapus data mahasiswa
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        // Reset auto increment di SQLite (tidak wajib di MySQL)
        DB::statement("DELETE FROM sqlite_sequence WHERE name='mahasiswa'");

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    /**
     * AJAX: Ambil daftar Prodi berdasarkan Fakultas
     */
    public function getProdiByFakultas($fakultas_id)
    {
        $prodis = Prodi::where('fakultas_id', $fakultas_id)->get();
        return response()->json($prodis);
    }
}
