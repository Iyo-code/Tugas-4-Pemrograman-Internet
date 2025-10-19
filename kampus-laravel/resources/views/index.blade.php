<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Mahasiswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-50 to-blue-100 min-h-screen font-sans text-gray-800">
  <div class="max-w-6xl mx-auto py-10 px-4">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-4xl font-extrabold text-blue-800">📋 Daftar Mahasiswa</h1>
      <a href="{{ route('mahasiswa.create') }}" 
         class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow-md transition-all duration-200">
         + Tambah Mahasiswa
      </a>
    </div>

    {{-- Navigasi dan Pencarian --}}
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 space-y-3 sm:space-y-0 sm:space-x-3">
      {{-- Form Pencarian --}}
      <form method="GET" action="{{ route('mahasiswa.index') }}" 
            class="flex items-center w-full sm:w-auto space-x-2">
        <input type="text" name="search" value="{{ $keyword ?? '' }}"
               placeholder="Cari nama, NIM, prodi, fakultas..."
               class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 w-full sm:w-72">
        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200 shadow-sm">
          🔍 Cari
        </button>
      </form>

      {{-- Tombol Navigasi Fakultas dan Prodi --}}
      <div class="flex space-x-2">
        <a href="{{ route('fakultas.index') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-sm hover:bg-blue-700 transition duration-200">
           🏛️ Fakultas
        </a>
        <a href="{{ route('prodi.index') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-sm hover:bg-blue-700 transition duration-200">
           🎓 Prodi
        </a>
      </div>
    </div>

    {{-- Pesan sukses --}}
    @if (session('success'))
      <div class="bg-green-50 border border-green-400 text-green-700 px-4 py-3 rounded-md mb-6 flex items-center shadow-sm">
        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span>{{ session('success') }}</span>
      </div>
    @endif

    {{-- Tabel data --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
      <table class="min-w-full">
        <thead class="bg-blue-600 text-white uppercase text-sm">
          <tr>
            <th class="px-6 py-3 text-left font-semibold">ID</th>
            <th class="px-6 py-3 text-left font-semibold">NIM</th>
            <th class="px-6 py-3 text-left font-semibold">Nama</th>
            <th class="px-6 py-3 text-left font-semibold">Program Studi</th>
            <th class="px-6 py-3 text-left font-semibold">Fakultas</th>
            <th class="px-6 py-3 text-center font-semibold">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          @forelse ($mahasiswa as $m)
            <tr class="hover:bg-blue-50 transition">
              <td class="px-6 py-3">{{ $m->id }}</td>
              <td class="px-6 py-3">{{ $m->nim }}</td>
              <td class="px-6 py-3">{{ $m->nama }}</td>
              <td class="px-6 py-3">{{ $m->prodi->nama_prodi ?? '-' }}</td>
              <td class="px-6 py-3">{{ $m->prodi->fakultas->nama_fakultas ?? '-' }}</td>
              <td class="px-6 py-3 text-center">
                <a href="{{ route('mahasiswa.edit', $m->id) }}" 
                   class="text-blue-600 hover:text-blue-800 font-semibold">Edit</a>
                <form action="{{ route('mahasiswa.destroy', $m->id) }}" method="POST" class="inline-block ml-3">
                  @csrf
                  @method('DELETE')
                  <button type="submit" onclick="return confirm('Yakin ingin menghapus data ini?')" 
                          class="text-red-600 hover:text-red-800 font-semibold">
                    Hapus
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data mahasiswa.</td>
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
</body>
</html>
