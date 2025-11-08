<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Fakultas</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-gradient-to-br from-gray-50 via-blue-50 to-blue-100 min-h-screen font-sans text-gray-800">

  <div class="max-w-7xl mx-auto py-10 px-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-center mb-10 gap-4">
      <h1 class="text-4xl font-extrabold text-blue-800 flex items-center gap-2">
        <i data-lucide="building" class="w-8 h-8 text-blue-700"></i>
        Daftar Fakultas
      </h1>

      <a href="{{ route('mahasiswa.index') }}" 
         class="bg-gray-100 hover:bg-gray-200 text-blue-800 px-4 py-2 rounded-lg shadow-sm flex items-center gap-2 transition">
        <i data-lucide="arrow-left" class="w-5 h-5"></i> Kembali ke Mahasiswa
      </a>
    </div>

    {{-- Message Success --}}
    @if (session('success'))
      <div class="bg-green-50 border border-green-400 text-green-700 px-4 py-3 rounded-md mb-6 flex items-center shadow-sm">
        <i data-lucide="check-circle" class="w-5 h-5 mr-2 text-green-600"></i>
        <span>{{ session('success') }}</span>
      </div>
    @endif

    {{-- Error --}}
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

    {{-- FORM PENCARIAN (USER SAJA) --}}
    @if (auth()->user()->role !== 'admin')
    <div class="bg-white p-5 rounded-xl shadow-md border border-gray-200 mb-8">
      <form method="GET" action="{{ route('fakultas.index') }}" 
            class="flex flex-wrap items-center gap-3">

        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Cari nama fakultas..."
               class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 w-full sm:w-64">

        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200 shadow-sm flex items-center gap-2">
          <i data-lucide="search" class="w-4 h-4"></i> Cari
        </button>

      </form>
    </div>
    @endif

    {{-- FORM TAMBAH (ADMIN SAJA) --}}
    @if (auth()->user()->role === 'admin')
    <div class="bg-white p-5 rounded-xl shadow-md border border-gray-200 mb-8">
      <form action="{{ route('fakultas.store') }}" method="POST" 
            class="flex flex-col sm:flex-row items-center justify-between gap-4">
        @csrf

        <input type="text" name="nama_fakultas" value="{{ old('nama_fakultas') }}" 
               placeholder="Masukkan nama fakultas..."
               class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 w-full sm:w-2/3">

        <button type="submit"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition duration-200 shadow-sm flex items-center gap-2">
          <i data-lucide="plus-circle" class="w-5 h-5"></i> Tambah Fakultas
        </button>

      </form>
    </div>
    @endif

    {{-- TABLE --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
      <table class="min-w-full">
        <thead class="bg-blue-700 text-white uppercase text-sm">
          <tr>
            <th class="px-6 py-3 text-left font-semibold">ID</th>
            <th class="px-6 py-3 text-left font-semibold">Nama Fakultas</th>

            @if (auth()->user()->role === 'admin')
              <th class="px-6 py-3 text-center font-semibold">Aksi</th>
            @endif
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">
          @forelse ($fakultas as $f)
            <tr class="hover:bg-blue-50 transition duration-150">
              <td class="px-6 py-3">{{ $f->id }}</td>
              <td class="px-6 py-3">{{ $f->nama_fakultas }}</td>

              @if (auth()->user()->role === 'admin')
              <td class="px-6 py-3 text-center">
                <div class="flex justify-center items-center gap-4">

                  {{-- Edit --}}
                  <a href="{{ route('fakultas.edit', $f->id) }}" 
                     class="text-blue-600 hover:text-blue-800 font-medium flex items-center gap-1 transition">
                    <i data-lucide="edit-2" class="w-4 h-4"></i> Edit
                  </a>

                  {{-- Hapus --}}
                  <form action="{{ route('fakultas.destroy', $f->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus fakultas ini?')">
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
              <td colspan="3" class="px-6 py-6 text-center text-gray-500">Belum ada data fakultas.</td>
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
