<section class="space-y-6">

    {{-- TITLE --}}
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Informasi Profil
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Perbarui informasi dasar akun Anda.
        </p>
    </header>

    {{-- Form --}}
    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        {{-- Name --}}
        <div>
            <label for="name" class="block font-medium text-gray-800 mb-1">Nama</label>
            <input id="name" name="name" type="text"
                   value="{{ old('name', $user->name) }}"
                   class="border-2 border-gray-400 rounded-lg px-4 py-2 w-full
                          focus:ring-2 focus:ring-blue-400 focus:border-blue-600">
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block font-medium text-gray-800 mb-1">Email</label>
            <input id="email" name="email" type="email"
                   value="{{ old('email', $user->email) }}"
                   class="border-2 border-gray-400 rounded-lg px-4 py-2 w-full
                          focus:ring-2 focus:ring-blue-400 focus:border-blue-600">
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        {{-- Save Button --}}
        <div class="flex justify-start">
            <button type="submit"
                    class="px-5 py-2 bg-blue-700 hover:bg-blue-800 text-white font-semibold rounded-lg shadow">
                Simpan Perubahan
            </button>
        </div>
    </form>
</section>
