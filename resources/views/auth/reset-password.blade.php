<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-[11px] font-black uppercase tracking-[2px] text-[color:var(--dark)]/70 mb-2 ml-1">Email</label>
            <input id="email" class="input-genz w-full" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 font-bold text-xs" />
        </div>

        <!-- Password -->
        <div class="mt-6">
            <label for="password" class="block text-[11px] font-black uppercase tracking-[2px] text-[color:var(--dark)]/70 mb-2 ml-1">Password Baru</label>
            <input id="password" class="input-genz w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 font-bold text-xs" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-6">
            <label for="password_confirmation" class="block text-[11px] font-black uppercase tracking-[2px] text-[color:var(--dark)]/70 mb-2 ml-1">Konfirmasi Password Baru</label>
            <input id="password_confirmation" class="input-genz w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600 font-bold text-xs" />
        </div>

        <div class="flex items-center justify-end mt-8">
            <button type="submit" class="btn-genz w-full">
                Simpan Password Baru
            </button>
        </div>
    </form>
</x-guest-layout>
