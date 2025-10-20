<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function destroy(Fakultas $fakultas)
    {
        $fakultas->delete();

        DB::statement("DELETE FROM sqlite_sequence WHERE name='fakultas'");

        return redirect()->route('fakultas.index')->with('success', 'Fakultas berhasil dihapus.');
    }
}
