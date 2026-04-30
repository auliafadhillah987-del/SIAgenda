<x-guest-layout>
    <div class="mb-6 text-sm font-bold text-[color:var(--dark)]/70 leading-relaxed">
        Lupa password Anda? Tidak masalah. Cukup beri tahu kami alamat email Anda dan kami akan mengirimi Anda tautan untuk mereset password.
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-[11px] font-black uppercase tracking-[2px] text-[color:var(--dark)]/70 mb-2 ml-1">Email Address</label>
            <input id="email" class="input-genz w-full" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 font-bold text-xs" />
        </div>

        <div class="flex items-center justify-end mt-8">
            <button type="submit" class="btn-genz w-full">
                Kirim Tautan Reset Password
            </button>
        </div>
        
        <div class="mt-8 pt-6 border-t-2 border-[color:var(--dark)]/10 text-center">
            <a href="{{ route('login') }}" class="text-[11px] font-black uppercase tracking-[1px] text-[color:var(--brick)] hover:text-[color:var(--orange)] transition underline decoration-2 underline-offset-4">Kembali ke Login</a>
        </div>
    </form>
</x-guest-layout>
