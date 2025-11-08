<section class="space-y-6">

    {{-- TITLE --}}
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Ubah Password
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Untuk keamanan akun Anda, gunakan password yang kuat dan rahasia.
        </p>
    </header>

    {{-- Form --}}
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        {{-- Current Password --}}
        <div>
            <label for="current_password" class="block font-medium text-gray-800 mb-1">Password Saat Ini</label>
            <input id="current_password" name="current_password" type="password"
                   class="border-2 border-gray-400 rounded-lg px-4 py-2 w-full
                          focus:ring-2 focus:ring-blue-400 focus:border-blue-600">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        {{-- New Password --}}
        <div>
            <label for="password" class="block font-medium text-gray-800 mb-1">Password Baru</label>
            <input id="password" name="password" type="password"
                   class="border-2 border-gray-400 rounded-lg px-4 py-2 w-full
                          focus:ring-2 focus:ring-blue-400 focus:border-blue-600">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        {{-- Confirm --}}
        <div>
            <label for="password_confirmation" class="block font-medium text-gray-800 mb-1">Konfirmasi Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password"
                   class="border-2 border-gray-400 rounded-lg px-4 py-2 w-full
                          focus:ring-2 focus:ring-blue-400 focus:border-blue-600">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        {{-- Save Button --}}
        <div class="flex justify-start">
            <button type="submit"
                    class="px-5 py-2 bg-blue-700 hover:bg-blue-800 text-white font-semibold rounded-lg shadow">
                Perbarui Password
            </button>
        </div>
    </form>

</section>
