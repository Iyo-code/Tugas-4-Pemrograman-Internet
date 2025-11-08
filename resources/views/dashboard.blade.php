<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-gradient-to-br from-gray-50 via-blue-50 to-blue-100 min-h-screen font-sans text-gray-800">

    <div class="max-w-7xl mx-auto py-10 px-6">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-10">
            <h1 class="text-4xl font-extrabold text-blue-800 flex items-center gap-2">
                <i data-lucide="layout-dashboard" class="w-8 h-8 text-blue-700"></i>
                Dashboard
            </h1>

            {{-- DROPDOWN PROFILE --}}
            <div class="relative" x-data="{ open: false }">
                <button 
                    @click="open = !open"
                    class="flex items-center gap-2 bg-white px-4 py-2 rounded-lg shadow-sm hover:bg-gray-100 transition"
                >
                    <i data-lucide="user" class="w-5 h-5 text-blue-700"></i>
                    <span>{{ Auth::user()->name }}</span>
                    <i data-lucide="chevron-down" class="w-4 h-4"></i>
                </button>

                <div 
                    x-show="open" 
                    @click.outside="open = false"
                    class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg overflow-hidden border"
                >
                    <a href="{{ route('profile.edit') }}" 
                       class="block px-4 py-2 hover:bg-gray-100 text-gray-700">Edit Profil</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button 
                            class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        </div>

        {{-- 3 KOTAK MENU --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mt-8">

            {{-- Mahasiswa --}}
            <a href="{{ route('mahasiswa.index') }}"
               class="bg-white hover:bg-blue-50 hover:shadow-lg transition p-8 rounded-2xl shadow-md border flex flex-col items-center text-center">
                <i data-lucide="users" class="w-12 h-12 text-blue-700 mb-4"></i>

                @if(auth()->user()->role === 'admin')
                    <h3 class="text-2xl font-semibold text-blue-800">Kelola Mahasiswa</h3>
                    <p class="text-gray-600 text-sm mt-2">Tambah & ubah data mahasiswa</p>
                @else
                    <h3 class="text-2xl font-semibold text-blue-800">Lihat Mahasiswa</h3>
                    <p class="text-gray-600 text-sm mt-2">Lihat daftar mahasiswa</p>
                @endif
            </a>

            {{-- Prodi --}}
            <a href="{{ route('prodi.index') }}"
               class="bg-white hover:bg-blue-50 hover:shadow-lg transition p-8 rounded-2xl shadow-md border flex flex-col items-center text-center">
                <i data-lucide="graduation-cap" class="w-12 h-12 text-blue-700 mb-4"></i>

                @if(auth()->user()->role === 'admin')
                    <h3 class="text-2xl font-semibold text-blue-800">Kelola Prodi</h3>
                    <p class="text-gray-600 text-sm mt-2">Tambah & ubah data prodi</p>
                @else
                    <h3 class="text-2xl font-semibold text-blue-800">Lihat Prodi</h3>
                    <p class="text-gray-600 text-sm mt-2">Lihat daftar prodi</p>
                @endif
            </a>

            {{-- Fakultas --}}
            <a href="{{ route('fakultas.index') }}"
               class="bg-white hover:bg-blue-50 hover:shadow-lg transition p-8 rounded-2xl shadow-md border flex flex-col items-center text-center">
                <i data-lucide="building-2" class="w-12 h-12 text-blue-700 mb-4"></i>

                @if(auth()->user()->role === 'admin')
                    <h3 class="text-2xl font-semibold text-blue-800">Kelola Fakultas</h3>
                    <p class="text-gray-600 text-sm mt-2">Tambah & ubah data fakultas</p>
                @else
                    <h3 class="text-2xl font-semibold text-blue-800">Lihat Fakultas</h3>
                    <p class="text-gray-600 text-sm mt-2">Lihat daftar fakultas</p>
                @endif
            </a>

        </div>

        {{-- FOOTER --}}
        <footer class="text-center text-gray-500 text-sm mt-10">
            &copy; {{ date('Y') }} - Sistem Data Mahasiswa |
            <span class="font-medium text-gray-600">Trio Suro Wibowo</span>
        </footer>

    </div>

    <script>lucide.createIcons();</script>

</body>
</html>
