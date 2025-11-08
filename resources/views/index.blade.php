<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Mahasiswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gradient-to-br from-gray-50 via-blue-50 to-blue-100 min-h-screen font-sans text-gray-800">

  <div class="max-w-7xl mx-auto py-10 px-6">
    
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-center mb-10 gap-4">
      <h1 class="text-4xl font-extrabold text-blue-800 flex items-center gap-2">
        <i data-lucide="users" class="w-8 h-8 text-blue-700"></i>
        Daftar Mahasiswa
      </h1>

      {{-- Navigasi Fakultas & Prodi --}}
      <div class="flex gap-2">
        <a href="{{ route('fakultas.index') }}" 
           class="bg-gray-100 hover:bg-gray-200 text-blue-800 px-4 py-2 rounded-lg shadow-sm flex items-center gap-2 transition">
           <i data-lucide="building-2" class="w-5 h-5"></i> Fakultas
        </a>

        <a href="{{ route('prodi.index') }}" 
           class="bg-gray-100 hover:bg-gray-200 text-blue-800 px-4 py-2 rounded-lg shadow-sm flex items-center gap-2 transition">
           <i data-lucide="graduation-cap" class="w-5 h-5"></i> Prodi
        </a>
      </div>
    </div>

    {{-- Filter --}}
    <div class="bg-white p-5 rounded-xl shadow-md border border-gray-200 mb-8">
      <div class="flex flex-col lg:flex-row items-center justify-between gap-4">

        {{-- Form Filter --}}
        <form method="GET" action="{{ route('mahasiswa.index') }}" 
              class="flex flex-wrap items-center gap-3 w-full lg:w-auto flex-grow">

          <input type="text" name="search" value="{{ request('search') }}"
                 placeholder="Cari nama, NIM..."
                 class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 w-full sm:w-64">

          {{-- Filter Fakultas --}}
          <select name="fakultas_id" 
                  class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400">
            <option value="">Semua Fakultas</option>
            @foreach ($fakultas as $f)
              <option value="{{ $f->id }}" {{ request('fakultas_id') == $f->id ? 'selected' : '' }}>
                {{ $f->nama_fakultas }}
              </option>
            @endforeach
          </select>

          {{-- Filter Prodi --}}
          <select name="prodi_id" 
                  class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400">
            <option value="">Semua Prodi</option>
            @foreach ($prodi as $p)
              <option value="{{ $p->id }}" {{ request('prodi_id') == $p->id ? 'selected' : '' }}>
                {{ $p->nama_prodi }}
              </option>
            @endforeach
          </select>

          {{-- Tombol Cari --}}
          <button type="submit"
                  class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200 shadow-sm flex items-center gap-2">
            <i data-lucide="search" class="w-4 h-4"></i> Cari
          </button>
        </form>

        {{-- Tombol Tambah — hanya admin --}}
        @if (auth()->user()->role === 'admin')
        <a href="{{ route('mahasiswa.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow-md transition-all duration-200 flex items-center gap-2">
           <i data-lucide="plus-circle" class="w-5 h-5"></i> Tambah Mahasiswa
        </a>
        @endif

      </div>
    </div>

    {{-- Pesan sukses --}}
    @if (session('success'))
      <div class="bg-green-50 border border-green-400 text-green-700 px-4 py-3 rounded-md mb-6 flex items-center shadow-sm">
        <i data-lucide="check-circle" class="w-5 h-5 mr-2 text-green-600"></i>
        <span>{{ session('success') }}</span>
      </div>
    @endif

    {{-- Tabel --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
      <table class="min-w-full">
        <thead class="bg-blue-700 text-white uppercase text-sm">
          <tr>
            <th class="px-6 py-3 text-left font-semibold">ID</th>
            <th class="px-6 py-3 text-left font-semibold">NIM</th>
            <th class="px-6 py-3 text-left font-semibold">Nama</th>
            <th class="px-6 py-3 text-left font-semibold">Program Studi</th>
            <th class="px-6 py-3 text-left font-semibold">Fakultas</th>

            {{-- Hanya admin yang bisa melihat kolom aksi --}}
            @if (auth()->user()->role === 'admin')
            <th class="px-6 py-3 text-center font-semibold">Aksi</th>
            @endif
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">
          @forelse ($mahasiswa as $m)
            <tr class="hover:bg-blue-50 transition duration-150">
              <td class="px-6 py-3">{{ $m->id }}</td>
              <td class="px-6 py-3">{{ $m->nim }}</td>
              <td class="px-6 py-3">{{ $m->nama }}</td>
              <td class="px-6 py-3">{{ $m->prodi->nama_prodi ?? '-' }}</td>
              <td class="px-6 py-3">{{ $m->prodi->fakultas->nama_fakultas ?? '-' }}</td>

              {{-- Aksi edit & hapus khusus admin --}}
              @if (auth()->user()->role === 'admin')
              <td class="px-6 py-3 text-center">
                <div class="flex justify-center items-center gap-4">

                  {{-- Edit --}}
                  <a href="{{ route('mahasiswa.edit', $m->id) }}" 
                     class="text-blue-600 hover:text-blue-800 font-medium flex items-center gap-1 transition">
                    <i data-lucide="edit-2" class="w-4 h-4"></i> Edit
                  </a>

                  {{-- Hapus --}}
                  <form action="{{ route('mahasiswa.destroy', $m->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600 hover:text-red-800 font-medium flex items-center gap-1 transition">
                      <i data-lucide="trash-2" class="w-4 h-4"></i> Hapus
                    </button>
                  </form>

                </div>
              </td>
              @endif

            </tr>
          @empty
            <tr>
              <td colspan="6" class="px-6 py-6 text-center text-gray-500">Belum ada data mahasiswa.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

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
