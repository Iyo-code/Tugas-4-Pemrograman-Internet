<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-lg font-semibold mb-4">
                        Selamat datang, {{ Auth::user()->name }} 👋

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                        {{-- Kelola Kampus --}}
                        <a href="{{ route('mahasiswa.index') }}" 
                           class="flex flex-col items-center justify-center bg-blue-600 hover:bg-blue-700 text-white py-10 rounded-xl shadow-lg transition transform hover:-translate-y-1 hover:shadow-xl focus:ring-4 focus:ring-blue-300 focus:outline-none">
                            <i data-lucide="building-2" class="w-8 h-8 mb-3"></i>
                            <span class="font-semibold text-lg">Kelola Kampus</span>
                        </a>
                    </div>

                    <p class="mt-6 text-gray-500 text-sm">
                        {{ __("You're logged in!") }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Lucide Icon Init --}}
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</x-app-layout>
