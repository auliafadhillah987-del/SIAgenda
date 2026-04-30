<x-guest-layout>
    <div class="mb-6 text-sm font-bold text-[color:var(--dark)]/70 leading-relaxed">
        Terima kasih telah mendaftar! Sebelum memulai, bisakah Anda memverifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan ke email Anda? Jika Anda tidak menerima email tersebut, kami akan dengan senang hati mengirimkannya kembali.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 px-4 py-3 bg-emerald-100 border-2 border-emerald-500 text-emerald-800 rounded-xl font-bold shadow-[4px_4px_0px_#10b981] text-sm">
            Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.
        </div>
    @endif

    <div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t-2 border-[color:var(--dark)]/10">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
            @csrf
            <button type="submit" class="btn-genz w-full sm:w-auto !py-3 !px-6 !text-[11px]">
                Kirim Ulang Email Verifikasi
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
            @csrf
            <button type="submit" class="w-full sm:w-auto text-[11px] font-black uppercase tracking-[1px] text-[color:var(--brick)] hover:text-[color:var(--orange)] transition underline decoration-2 underline-offset-4 bg-transparent border-none cursor-pointer py-2">
                Keluar Sesi
            </button>
        </form>
    </div>
</x-guest-layout>
