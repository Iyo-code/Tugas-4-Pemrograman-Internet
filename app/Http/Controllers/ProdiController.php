<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdiController extends Controller
{
    public function index()
    {
        $prodi = Prodi::with('fakultas')->orderBy('id', 'asc')->get();
        $fakultas = Fakultas::all();
        return view('prodi', compact('prodi', 'fakultas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_prodi' => 'required|string|max:255|unique:prodi,nama_prodi',
            'fakultas_id' => 'required|exists:fakultas,id',
        ], [
            'nama_prodi.required' => 'Nama prodi wajib diisi.',
            'nama_prodi.unique' => 'Nama prodi sudah ada, gunakan nama lain.',
            'fakultas_id.required' => 'Fakultas wajib dipilih.',
        ]);

        Prodi::create($request->only('nama_prodi', 'fakultas_id'));

        return redirect()->back()->with('success', 'Program studi berhasil ditambahkan.');
    }

    public function edit(Prodi $prodi)
    {
        $fakultas = Fakultas::all();
        return view('edit-prodi', compact('prodi', 'fakultas'));
    }

    public function update(Request $request, Prodi $prodi)
    {
        $request->validate([
            'nama_prodi' => 'required|string|max:255|unique:prodi,nama_prodi,' . $prodi->id,
            'fakultas_id' => 'required|exists:fakultas,id',
        ], [
            'nama_prodi.required' => 'Nama prodi wajib diisi.',
            'nama_prodi.unique' => 'Nama prodi sudah ada, gunakan nama lain.',
            'fakultas_id.required' => 'Fakultas wajib dipilih.',
        ]);

        $prodi->update($request->only('nama_prodi', 'fakultas_id'));

        return redirect()->route('prodi.index')->with('success', 'Data program studi berhasil diperbarui.');
    }

    public function destroy(Prodi $prodi)
    {
        $prodi->delete();

        DB::statement("DELETE FROM sqlite_sequence WHERE name='prodi'");

        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil dihapus.');
    }
}
