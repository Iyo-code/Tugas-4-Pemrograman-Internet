<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    public function index()
    {
        $fakultas = Fakultas::all();
        return view('fakultas', compact('fakultas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_fakultas' => 'required|string|max:255'
        ], [
            'nama_fakultas.required' => 'Nama fakultas wajib di isi.',
        ]);
        Fakultas::create($request->only('nama_fakultas'));

        return redirect()->back()->with('success', 'Fakultas berhasil ditambahkan!');
    }

    public function destroy(Fakultas $fakulta)
    {
        $fakulta->delete();
        return redirect()->back()->with('success', 'Fakultas berhasil dihapus!');
    }
}
