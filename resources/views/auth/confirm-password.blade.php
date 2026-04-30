<x-guest-layout>
    <div class="mb-6 text-sm font-bold text-[color:var(--dark)]/70 leading-relaxed">
        Ini adalah area aman dari aplikasi. Harap konfirmasi password Anda sebelum melanjutkan.
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <label for="password" class="block text-[11px] font-black uppercase tracking-[2px] text-[color:var(--dark)]/70 mb-2 ml-1">Password</label>
            <input id="password" class="input-genz w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 font-bold text-xs" />
        </div>

        <div class="flex justify-end mt-8">
            <button type="submit" class="btn-genz w-full">
                Konfirmasi Password
            </button>
        </div>
    </form>
</x-guest-layout>
