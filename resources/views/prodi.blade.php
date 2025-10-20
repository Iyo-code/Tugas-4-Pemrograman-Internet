<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Program Studi</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-gradient-to-br from-gray-50 via-blue-50 to-blue-100 min-h-screen font-sans text-gray-800">

  <div class="max-w-7xl mx-auto py-10 px-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-center mb-10 gap-4">
      <h1 class="text-4xl font-extrabold text-blue-800 flex items-center gap-2">
        <i data-lucide="graduation-cap" class="w-8 h-8 text-blue-700"></i>
        Daftar Program Studi
      </h1>

      {{-- Tombol kembali --}}
      <a href="{{ route('mahasiswa.index') }}" 
         class="bg-gray-100 hover:bg-gray-200 text-blue-800 px-4 py-2 rounded-lg shadow-sm flex items-center gap-2 transition">
        <i data-lucide="arrow-left" class="w-5 h-5"></i> Kembali ke Mahasiswa
      </a>
    </div>

    {{-- Pesan sukses --}}
    @if (session('success'))
      <div class="bg-green-50 border border-green-400 text-green-700 px-4 py-3 rounded-md mb-6 flex items-center shadow-sm">
        <i data-lucide="check-circle" class="w-5 h-5 mr-2 text-green-600"></i>
        <span>{{ session('success') }}</span>
      </div>
    @endif

    {{-- Validasi error (sekarang di atas form) --}}
    @if ($errors->any())
      <div class="bg-red-50 border border-red-400 text-red-600 px-4 py-3 rounded-md mb-6 shadow-sm">
        <div class="flex items-center gap-2 mb-1">
          <i data-lucide="alert-triangle" class="w-5 h-5 text-red-600"></i>
          <span class="font-semibold">Terjadi kesalahan:</span>
        </div>
        <ul class="list-disc ml-6 text-sm">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Form Tambah Prodi --}}
    <div class="bg-white p-5 rounded-xl shadow-md border border-gray-200 mb-8">
      <form action="{{ route('prodi.store') }}" method="POST" class="flex flex-col sm:flex-row items-center justify-between gap-4">
        @csrf
        <input type="text" name="nama_prodi" value="{{ old('nama_prodi') }}" placeholder="Masukkan nama program studi..."
               class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 w-full sm:w-1/2">

        <select name="fakultas_id"
                class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 w-full sm:w-1/3">
          <option value="">-- Pilih Fakultas --</option>
          @foreach ($fakultas as $f)
            <option value="{{ $f->id }}" {{ old('fakultas_id') == $f->id ? 'selected' : '' }}>
              {{ $f->nama_fakultas }}
            </option>
          @endforeach
        </select>

        <button type="submit"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition duration-200 shadow-sm flex items-center gap-2">
          <i data-lucide="plus-circle" class="w-5 h-5"></i> Tambah Prodi
        </button>
      </form>
    </div>

    {{-- Tabel Daftar Prodi --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
      <table class="min-w-full">
        <thead class="bg-blue-700 text-white uppercase text-sm">
          <tr>
            <th class="px-6 py-3 text-left font-semibold">ID</th>
            <th class="px-6 py-3 text-left font-semibold">Nama Program Studi</th>
            <th class="px-6 py-3 text-left font-semibold">Fakultas</th>
            <th class="px-6 py-3 text-center font-semibold">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          @forelse ($prodi as $p)
            <tr class="hover:bg-blue-50 transition duration-150">
              <td class="px-6 py-3">{{ $p->id }}</td>
              <td class="px-6 py-3">{{ $p->nama_prodi }}</td>
              <td class="px-6 py-3">{{ $p->fakultas->nama_fakultas ?? '-' }}</td>
              <td class="px-6 py-3 text-center">
                <div class="flex justify-center items-center gap-4">
                  {{-- Edit --}}
                  <a href="{{ route('prodi.edit', $p->id) }}" 
                     class="text-blue-600 hover:text-blue-800 font-medium flex items-center gap-1 transition">
                    <i data-lucide="edit-2" class="w-4 h-4"></i> Edit
                  </a>

                  {{-- Hapus --}}
                  <form action="{{ route('prodi.destroy', $p->id) }}" method="POST" 
                        onsubmit="return confirm('Yakin ingin menghapus program studi ini?')" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="text-red-600 hover:text-red-800 font-medium flex items-center gap-1 transition">
                      <i data-lucide="trash-2" class="w-4 h-4"></i> Hapus
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="px-6 py-6 text-center text-gray-500">Belum ada data program studi.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Footer --}}
    <footer class="text-center text-gray-500 text-sm mt-8">
      &copy; {{ date('Y') }} - Sistem Data Mahasiswa | 
      <span class="font-medium text-gray-600">Trio Suro Wibowo</span>
    </footer>

  </div>

  <script>
    lucide.createIcons();
  </script>

</body>
</html>
