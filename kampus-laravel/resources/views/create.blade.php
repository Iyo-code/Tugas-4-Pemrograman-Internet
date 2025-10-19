<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Mahasiswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gradient-to-br from-gray-50 to-blue-100 min-h-screen font-sans text-gray-800">
  <div class="max-w-3xl mx-auto py-10 px-6 bg-white shadow-xl rounded-xl mt-10">
    
    {{-- Header --}}
    <div class="mb-8 text-center">
      <h1 class="text-3xl font-bold text-blue-800">➕ Tambah Mahasiswa</h1>
      <p class="text-gray-500 text-sm mt-1">Isi data dengan lengkap dan benar.</p>
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

    {{-- Form Tambah --}}
    <form action="{{ route('mahasiswa.store') }}" method="POST" class="space-y-5">
      @csrf

      {{-- NIM --}}
      <div>
        <label class="block font-semibold mb-1 text-gray-700">NIM</label>
        <input type="text" name="nim" value="{{ old('nim') }}"
               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
      </div>

      {{-- Nama --}}
      <div>
        <label class="block font-semibold mb-1 text-gray-700">Nama</label>
        <input type="text" name="nama" value="{{ old('nama') }}"
               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
      </div>

      {{-- Fakultas --}}
      <div>
        <label class="block font-semibold mb-1 text-gray-700">Fakultas</label>
        <select name="fakultas_id" id="fakultas"
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
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
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
          <option value="">-- Pilih Prodi --</option>
        </select>
      </div>

      {{-- Tombol --}}
      <div class="flex justify-between items-center pt-4">
        <a href="{{ route('mahasiswa.index') }}"
           class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition">
          ← Kembali
        </a>
        <button type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded-md font-semibold hover:bg-blue-700 transition">
          Simpan
        </button>
      </div>
    </form>

    {{-- Footer --}}
    <footer class="text-center text-gray-500 text-sm mt-10">
      &copy; {{ date('Y') }} - Sistem Data Mahasiswa | <span class="font-medium text-gray-600">Trio Suro Wibowo</span>
    </footer>
  </div>

  {{-- Script Dropdown Dinamis --}}
  <script>
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
