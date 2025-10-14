<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Daftar Mahasiswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { transition: background 0.3s ease-in-out; }
  </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-blue-100 min-h-screen font-sans text-gray-800">
  <div class="max-w-5xl mx-auto py-10 px-4">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-8">
      <div>
        <h1 class="text-4xl font-extrabold text-blue-800 tracking-tight">📋 Daftar Mahasiswa</h1>
        <p class="text-gray-500 text-sm mt-1">Kelola data mahasiswa dengan mudah.</p>
      </div>
      <a href="{{ route('mahasiswa.create') }}" 
         class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow-md transition-all duration-200">
         + Tambah Mahasiswa
      </a>
    </div>

    {{-- Pesan sukses --}}
    @if (session('success'))
      <div class="bg-green-50 border border-green-400 text-green-700 px-4 py-3 rounded-md mb-6 flex items-center">
        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M5 13l4 4L19 7" />
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
            <th class="px-6 py-3 text-left font-semibold">Prodi</th>
            <th class="px-6 py-3 text-center font-semibold">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          @forelse ($mahasiswa as $m)
            <tr class="hover:bg-blue-50 transition">
              <td class="px-6 py-3">{{ $m->id }}</td>
              <td class="px-6 py-3 font-mono text-gray-700">{{ $m->nim }}</td>
              <td class="px-6 py-3">{{ $m->nama }}</td>
              <td class="px-6 py-3">{{ $m->prodi }}</td>
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
              <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada data mahasiswa.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Footer --}}
    <footer class="text-center text-gray-500 text-sm mt-8">
      &copy; {{ date('Y') }} - Sistem Data Mahasiswa | <span class="font-medium text-gray-600">Trio Suro Wibowo</span>
    </footer>
  </div>
</body>
</html>
