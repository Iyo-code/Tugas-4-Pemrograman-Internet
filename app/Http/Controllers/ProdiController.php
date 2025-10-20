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
            'nama_prodi' => 'required|unique:prodi,nama_prodi',
            'fakultas_id' => 'required|exists:fakultas,id',
             ], [
            'nama_prodi.required' => 'Nama prodi wajib di isi.',
            'fakultas_id.required' => 'Nama fakultas wajib di isi.',
        ]);

        Prodi::create($request->only('nama_prodi', 'fakultas_id'));

        return redirect()->back()->with('success', 'Program studi berhasil ditambahkan.');
    }

    public function destroy(Prodi $prodi)
    {
        $prodi->delete();

        DB::statement("DELETE FROM sqlite_sequence WHERE name='prodi'");

        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil dihapus.');
    }
}
