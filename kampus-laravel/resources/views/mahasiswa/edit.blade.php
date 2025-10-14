<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Mahasiswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-gray-50 to-blue-100 min-h-screen font-sans text-gray-800">
  <div class="max-w-3xl mx-auto py-10 px-6 bg-white shadow-xl rounded-xl mt-10">
    
    {{-- Header --}}
    <div class="mb-8 text-center">
      <h1 class="text-3xl font-bold text-blue-800">✏️ Edit Mahasiswa</h1>
      <p class="text-gray-500 text-sm mt-1">Perbarui data mahasiswa berikut.</p>
    </div>

    {{-- Error Validation --}}
    @if ($errors->any())
      <div class="bg-red-50 border border-red-400 text-red-600 px-4 py-3 rounded mb-6">
        <ul class="list-disc ml-5 text-sm">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Form Edit --}}
    <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST" class="space-y-5">
      @csrf
      @method('PUT')

      <div>
        <label class="block font-semibold mb-1 text-gray-700">NIM</label>
        <input type="text" name="nim" value="{{ old('nim', $mahasiswa->nim) }}"
               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
      </div>

      <div>
        <label class="block font-semibold mb-1 text-gray-700">Nama</label>
        <input type="text" name="nama" value="{{ old('nama', $mahasiswa->nama) }}"
               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
      </div>

      <div>
        <label class="block font-semibold mb-1 text-gray-700">Program Studi</label>
        <input type="text" name="prodi" value="{{ old('prodi', $mahasiswa->prodi) }}"
               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
      </div>

      <div class="flex justify-between items-center pt-4">
        <a href="{{ route('mahasiswa.index') }}"
           class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition">
          ← Kembali
        </a>
        <button type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded-md font-semibold hover:bg-blue-700 transition">
          Update
        </button>
      </div>
    </form>

    {{-- Footer --}}
    <footer class="text-center text-gray-500 text-sm mt-10">
      &copy; {{ date('Y') }} - Sistem Data Mahasiswa | <span class="font-medium text-gray-600">Trio Suro Wibowo</span>
    </footer>
  </div>
</body>
</html>
