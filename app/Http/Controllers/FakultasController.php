<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FakultasController extends Controller
{
    /**
     * Tampilkan daftar semua fakultas
     */
    public function index()
    {
        $fakultas = Fakultas::orderBy('id', 'asc')->get();
        return view('fakultas', compact('fakultas'));
    }

    /**
     * Simpan fakultas baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_fakultas' => 'required|string|max:255|unique:fakultas,nama_fakultas',
        ], [
            'nama_fakultas.required' => 'Nama fakultas wajib diisi.',
            'nama_fakultas.unique' => 'Nama fakultas sudah ada, gunakan nama lain.',
        ]);

        Fakultas::create([
            'nama_fakultas' => $request->nama_fakultas,
        ]);

        return redirect()->back()->with('success', 'Fakultas berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit fakultas
     */
    public function edit($id)
    {
        $fakultas = Fakultas::findOrFail($id);

        return view('edit-fakultas', compact('fakultas'));
    }

    /**
     * Proses update data fakultas
     */
    public function update(Request $request, $id)
    {
        $fakultas = Fakultas::findOrFail($id);

        $request->validate([
            'nama_fakultas' => 'required|string|max:255|unique:fakultas,nama_fakultas,' . $id,
        ], [
            'nama_fakultas.required' => 'Nama fakultas wajib diisi.',
            'nama_fakultas.unique' => 'Nama fakultas sudah ada, gunakan nama lain.',
        ]);

        $fakultas->update([
            'nama_fakultas' => $request->nama_fakultas,
        ]);

        return redirect()->route('fakultas.index')->with('success', 'Data fakultas berhasil diperbarui.');
    }

    /**
     * Hapus fakultas dari database
     */
    public function destroy(Fakultas $fakultas)
    {
        $fakultas->delete();

        DB::statement("DELETE FROM sqlite_sequence WHERE name='fakultas'");

        return redirect()->route('fakultas.index')->with('success', 'Fakultas berhasil dihapus.');
    }
}
