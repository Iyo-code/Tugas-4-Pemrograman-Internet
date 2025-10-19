<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Program Studi</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-gray-50 to-blue-100 min-h-screen font-sans text-gray-800">
  <div class="max-w-5xl mx-auto py-10 px-6 bg-white shadow-xl rounded-xl mt-10">

    {{-- Header --}}
    <div class="mb-8 text-center">
      <h1 class="text-3xl font-bold text-blue-800">🎓 Data Program Studi</h1>
    </div>

    {{-- Pesan sukses --}}
    @if (session('success'))
      <div class="bg-green-50 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
      </div>
    @endif

    {{-- Validasi error --}}
    @if ($errors->any())
      <div class="bg-red-50 border border-red-400 text-red-600 px-4 py-3 rounded mb-6">
        <ul class="list-disc ml-5 text-sm">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Form Tambah Prodi --}}
    <form action="{{ route('prodi.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-8">
      @csrf

      <input type="text" name="nama_prodi" placeholder="Nama Prodi"
             class="border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">

      <select name="fakultas_id"
              class="border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
        <option value="">-- Pilih Fakultas --</option>
        @foreach ($fakultas as $f)
          <option value="{{ $f->id }}">{{ $f->nama_fakultas }}</option>
        @endforeach
      </select>

      <button type="submit"
              class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
        + Tambah Prodi
      </button>
    </form>

    {{-- Tabel Daftar Prodi --}}
    <div class="bg-white rounded-lg shadow overflow-hidden border border-gray-100">
      <table class="min-w-full">
        <thead class="bg-blue-600 text-white uppercase text-sm">
          <tr>
            <th class="px-6 py-3 text-left font-semibold">ID</th>
            <th class="px-6 py-3 text-left font-semibold">Nama Prodi</th>
            <th class="px-6 py-3 text-left font-semibold">Fakultas</th>
            <th class="px-6 py-3 text-center font-semibold">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          @forelse ($prodi as $p)
            <tr class="hover:bg-blue-50 transition">
              <td class="px-6 py-3">{{ $p->id }}</td>
              <td class="px-6 py-3">{{ $p->nama_prodi }}</td>
              <td class="px-6 py-3">{{ $p->fakultas->nama_fakultas ?? '-' }}</td>
              <td class="px-6 py-3 text-center">
                <form action="{{ route('prodi.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus prodi ini?')" class="inline-block">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">
                    Hapus
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada data prodi.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Tombol kembali --}}
    <div class="mt-6 text-center">
      <a href="{{ route('mahasiswa.index') }}" 
         class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 transition">
        ← Kembali ke Mahasiswa
      </a>
    </div>

    {{-- Footer --}}
    <footer class="text-center text-gray-500 text-sm mt-10">
      &copy; {{ date('Y') }} - Sistem Data Mahasiswa | <span class="font-medium text-gray-600">Trio Suro Wibowo</span>
    </footer>

  </div>
</body>
</html>
