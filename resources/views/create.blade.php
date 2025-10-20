<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Mahasiswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gradient-to-br from-gray-50 via-blue-50 to-blue-100 min-h-screen font-sans text-gray-800">
  <div class="max-w-3xl mx-auto py-10 px-6 bg-white shadow-lg rounded-2xl mt-12 border border-gray-200">
    
    {{-- Header --}}
    <div class="mb-8 text-center">
      <h1 class="text-4xl font-extrabold text-blue-800 flex justify-center items-center gap-2">
        <i data-lucide="user-plus" class="w-8 h-8 text-blue-700"></i>
        Tambah Mahasiswa
      </h1>
      <p class="text-gray-500 text-sm mt-2">Isi data mahasiswa dengan lengkap dan benar.</p>
    </div>

    {{-- Error Validation (versi elegan & seragam) --}}
    @if ($errors->any())
      <div class="bg-red-50 border border-red-400 text-red-600 px-4 py-3 rounded-lg mb-6 shadow-sm">
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

    {{-- Form Tambah --}}
    <form action="{{ route('mahasiswa.store') }}" method="POST" class="space-y-5">
      @csrf

      {{-- NIM --}}
      <div>
        <label class="block font-semibold mb-1 text-gray-700">NIM</label>
        <input type="text" name="nim" value="{{ old('nim') }}"
               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
      </div>

      {{-- Nama --}}
      <div>
        <label class="block font-semibold mb-1 text-gray-700">Nama</label>
        <input type="text" name="nama" value="{{ old('nama') }}"
               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
      </div>

      {{-- Fakultas --}}
      <div>
        <label class="block font-semibold mb-1 text-gray-700">Fakultas</label>
        <select name="fakultas_id" id="fakultas"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
          <option value="">-- Pilih Fakultas --</option>
          @foreach ($fakultas as $f)
            <option value="{{ $f->id }}" {{ old('fakultas_id') == $f->id ? 'selected' : '' }}>
              {{ $f->nama_fakultas }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- Program Studi --}}
      <div>
        <label class="block font-semibold mb-1 text-gray-700">Program Studi</label>
        <select name="prodi_id" id="prodi"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
          <option value="">-- Pilih Prodi --</option>
        </select>
      </div>

      {{-- Tombol --}}
      <div class="flex justify-between items-center pt-6 border-t border-gray-200 mt-8">
        <a href="{{ route('mahasiswa.index') }}"
           class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-5 py-2 rounded-lg transition flex items-center gap-2">
          <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
        </a>

        <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition flex items-center gap-2">
          <i data-lucide="save" class="w-5 h-5"></i> Simpan Data
        </button>
      </div>
    </form>

    {{-- Footer --}}
    <footer class="text-center text-gray-500 text-sm mt-10">
      &copy; {{ date('Y') }} - Sistem Data Mahasiswa |
      <span class="font-medium text-gray-600">Trio Suro Wibowo</span>
    </footer>
  </div>

  {{-- Script Dropdown Dinamis --}}
  <script>
    lucide.createIcons();

    function loadProdi(fakultas_id, selected_prodi = null) {
      $('#prodi').html('<option value="">-- Pilih Prodi --</option>');

      if (fakultas_id) {
        $.get('/get-prodi/' + fakultas_id, function(data) {
          $.each(data, function(index, prodi) {
            let selected = selected_prodi == prodi.id ? 'selected' : '';
            $('#prodi').append('<option value="' + prodi.id + '" ' + selected + '>' + prodi.nama_prodi + '</option>');
          });
        });
      }
    }

    $(document).ready(function() {
      var oldFakultas = '{{ old("fakultas_id") }}';
      var oldProdi = '{{ old("prodi_id") }}';
      if (oldFakultas) {
        $('#fakultas').val(oldFakultas);
        loadProdi(oldFakultas, oldProdi);
      }

      $('#fakultas').on('change', function() {
        loadProdi($(this).val());
      });
    });
  </script>
</body>
</html>
