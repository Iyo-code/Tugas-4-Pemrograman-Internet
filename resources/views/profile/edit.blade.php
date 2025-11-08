<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Pengguna</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    {{-- WAJIB agar modal delete berfungsi --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gradient-to-br from-gray-50 via-blue-50 to-blue-100 min-h-screen">

<div class="max-w-7xl mx-auto py-12 px-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-center mb-10 gap-4">
        <h1 class="text-4xl font-extrabold text-blue-800 flex items-center gap-3">
            <i data-lucide="user-cog" class="w-9 h-9 text-blue-700"></i>
            Pengaturan Profil
        </h1>

        <a href="{{ route('dashboard') }}"
           class="bg-gray-100 hover:bg-gray-200 text-blue-800 px-4 py-2 rounded-lg shadow-sm flex items-center gap-2 transition">
            <i data-lucide="arrow-left" class="w-5 h-5"></i> Kembali
        </a>
    </div>

    {{-- Informasi Profil --}}
    <div class="bg-white shadow-lg border border-gray-200 rounded-2xl p-8 mb-8">
        <h2 class="font-semibold text-xl text-blue-800 flex items-center gap-2 mb-5">
            <i data-lucide="id-card" class="w-6 h-6 text-blue-700"></i>
            Informasi Profil
        </h2>

        @include('profile.partials.update-profile-information-form')
    </div>

    {{-- Ubah Password --}}
    <div class="bg-white shadow-lg border border-gray-200 rounded-2xl p-8 mb-8">
        <h2 class="font-semibold text-xl text-blue-800 flex items-center gap-2 mb-5">
            <i data-lucide="lock" class="w-6 h-6 text-blue-700"></i>
            Ubah Password
        </h2>

        @include('profile.partials.update-password-form')
    </div>

    {{-- Hapus Akun --}}
    <div class="bg-white shadow-lg border border-gray-200 rounded-2xl p-8">
        <h2 class="font-semibold text-xl text-red-700 flex items-center gap-2 mb-5">
            <i data-lucide="user-x" class="w-6 h-6 text-red-600"></i>
            Hapus Akun
        </h2>

        @include('profile.partials.delete-user-form')
    </div>

    <footer class="text-center text-gray-500 text-sm mt-10">
        &copy; {{ date('Y') }} - Sistem Data Mahasiswa
    </footer>

</div>

<style>
    input, select, textarea {
        @apply border-2 border-gray-400 rounded-lg px-4 py-2 w-full
               focus:ring-2 focus:ring-blue-400 focus:border-blue-500;
    }
</style>

<script> lucide.createIcons(); </script>

</body>
</html>
