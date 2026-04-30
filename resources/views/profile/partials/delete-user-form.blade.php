<section class="space-y-6">
    <header>
        <h2 class="text-2xl font-extrabold text-[color:var(--dark)] tracking-tight">
            Hapus Akun
        </h2>

        <p class="mt-2 text-sm text-[color:var(--dark)]/70 font-bold">
            Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Harap simpan data yang Anda perlukan sebelum melanjutkan.
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="btn-genz !bg-[#9a2b0a] !shadow-[5px_5px_0px_var(--dark)] hover:!bg-[#fbb440]"
    >Hapus Akun</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-xl font-extrabold text-[color:var(--dark)] tracking-tight">
                Apakah Anda yakin ingin menghapus akun ini?
            </h2>

            <p class="mt-2 text-sm text-[color:var(--dark)]/70 font-bold">
                Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Silakan masukkan password Anda untuk konfirmasi.
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">Password</label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="input-genz mt-1 block w-full sm:w-3/4"
                    placeholder="Password"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3 border-t border-slate-100 pt-6">
                <button type="button" x-on:click="$dispatch('close')" class="btn-genz !bg-white !text-[color:var(--dark)] !shadow-[4px_4px_0px_var(--dark)] hover:!bg-slate-100 !py-3 !px-6 !text-[11px]">
                    Batal
                </button>

                <button type="submit" class="btn-genz !bg-[#9a2b0a] !shadow-[4px_4px_0px_var(--dark)] hover:!bg-[#fbb440] !py-3 !px-6 !text-[11px]">
                    Hapus Akun Permanen
                </button>
            </div>
        </form>
    </x-modal>
</section>
