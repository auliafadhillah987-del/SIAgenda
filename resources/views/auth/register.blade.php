<x-guest-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-[color:var(--krem)] tracking-tight">Daftar Akun Baru</h2>
        <p class="mt-2 text-sm text-[color:var(--krem)] font-bold italic">Bergabung dengan sistem SIAgenda sekarang</p>
    </x-slot>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-[11px] font-black uppercase tracking-[2px] text-[color:var(--dark)]/70 mb-2 ml-1">Nama Lengkap</label>
            <div class="mt-1">
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name"
                    class="input-genz">
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <label for="email" class="block text-[11px] font-black uppercase tracking-[2px] text-[color:var(--dark)]/70 mb-2 ml-1">Email</label>
            <div class="mt-1">
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username"
                    class="input-genz">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role Selection -->
        <div>
            <label for="role" class="block text-[11px] font-black uppercase tracking-[2px] text-[color:var(--dark)]/70 mb-2 ml-1">Daftar Sebagai</label>
            <div class="mt-1">
                <select id="role" name="role" required class="input-genz bg-white">
                    <option value="" disabled {{ old('role') ? '' : 'selected' }}>Saya adalah...</option>
                    <option value="siswa/orang tua siswa" {{ old('role') == 'siswa/orang tua siswa' ? 'selected' : '' }}>Siswa</option>
                    <option value="guru/staff" {{ old('role') == 'guru/staff' ? 'selected' : '' }}>Guru / Staff</option>
                </select>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="block text-[11px] font-black uppercase tracking-[2px] text-[color:var(--dark)]/70 mb-2 ml-1">Password</label>
            <div class="mt-1">
                <input id="password" name="password" type="password" required autocomplete="new-password"
                    class="input-genz">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-[11px] font-black uppercase tracking-[2px] text-[color:var(--dark)]/70 mb-2 ml-1">Konfirmasi Password</label>
            <div class="mt-1">
                <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                    class="input-genz">
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <button type="submit" class="btn-genz w-full">
                Daftar Sekarang
            </button>
        </div>
    </form>

    <div class="mt-8 pt-6 border-t-2 border-[color:var(--dark)]/10 text-center">
        <p class="text-[11px] uppercase tracking-[1px] text-[color:var(--dark)] font-bold">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="text-[color:var(--brick)] font-black hover:text-[color:var(--orange)] transition ml-1 underline decoration-2 underline-offset-4">Masuk di sini</a>
        </p>
    </div>
</x-guest-layout>