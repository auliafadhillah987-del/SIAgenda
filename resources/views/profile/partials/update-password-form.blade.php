<section>
    <header>
        <h2 class="text-2xl font-extrabold text-[color:var(--dark)] tracking-tight">
            Perbarui Password
        </h2>

        <p class="mt-2 text-sm text-[color:var(--dark)]/70 font-bold">
            Pastikan akun Anda menggunakan password yang panjang dan unik agar tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-[11px] font-black uppercase tracking-[2px] text-[color:var(--dark)]/70 mb-2 ml-1">Password Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" class="input-genz w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="block text-[11px] font-black uppercase tracking-[2px] text-[color:var(--dark)]/70 mb-2 ml-1">Password Baru</label>
            <input id="update_password_password" name="password" type="password" class="input-genz w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-[11px] font-black uppercase tracking-[2px] text-[color:var(--dark)]/70 mb-2 ml-1">Konfirmasi Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="input-genz w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-slate-100">
            <button type="submit" class="btn-genz !py-3 !px-6 !text-[11px] !shadow-[4px_4px_0px_var(--dark)]">Perbarui Password</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-[11px] font-black uppercase text-emerald-600 tracking-widest bg-emerald-50 px-3 py-1.5 rounded-lg"
                >Berhasil Diperbarui.</p>
            @endif
        </div>
    </form>
</section>
