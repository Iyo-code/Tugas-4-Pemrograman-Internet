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
     * Tampilkan semua data mahasiswa + fitur pencarian
     */
    public function index(Request $request)
    {
        $keyword = $request->input('search');

        $mahasiswa = Mahasiswa::with('prodi.fakultas')
            ->when($keyword, function ($query, $keyword) {
                $query->where('nama', 'like', "%{$keyword}%")
                      ->orWhere('nim', 'like', "%{$keyword}%")
                      ->orWhereHas('prodi', function ($q) use ($keyword) {
                          $q->where('nama_prodi', 'like', "%{$keyword}%");
                      })
                      ->orWhereHas('prodi.fakultas', function ($q) use ($keyword) {
                          $q->where('nama_fakultas', 'like', "%{$keyword}%");
                      });
            })
            ->orderBy('id', 'asc')
            ->get();

        return view('index', compact('mahasiswa', 'keyword'));
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

        DB::statement("DELETE FROM sqlite_sequence WHERE name='mahasiswa'");

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    /**
     * AJAX: Ambil Prodi berdasarkan Fakultas
     */
    public function getProdiByFakultas($fakultas_id)
    {
        $prodis = Prodi::where('fakultas_id', $fakultas_id)->get();
        return response()->json($prodis);
    }
}
