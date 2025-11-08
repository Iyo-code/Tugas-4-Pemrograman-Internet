<section class="space-y-6" x-data="">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Hapus Akun
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Setelah akun dihapus, semua data akan hilang permanen. Pastikan keputusan Anda benar.
        </p>
    </header>

    {{-- Tombol Buka Modal --}}
    <button
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow-sm">
        Hapus Akun
    </button>

    {{-- Modal --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                Apakah Anda yakin ingin menghapus akun ini?
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Masukkan password Anda untuk mengkonfirmasi penghapusan.
            </p>

            <div class="mt-4">
                <input type="password" name="password" placeholder="Password" class="w-full">
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <button type="button"
                        x-on:click="$dispatch('close')"
                        class="px-4 py-2 bg-gray-200 rounded-lg mr-2">
                    Batal
                </button>

                <button class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                    Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>
