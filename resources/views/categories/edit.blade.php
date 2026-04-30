@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4 relative z-10">
            <div>
                <a href="{{ route('categories.index') }}" class="group inline-flex items-center text-sm font-bold text-[color:var(--brick)] hover:text-[color:var(--dark)] transition-colors mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Batal dan Kembali
                </a>
                <h2 class="text-3xl font-extrabold text-[color:var(--dark)] tracking-tight">Edit Kategori</h2>
            </div>
        </div>

        <div class="bg-white/40 backdrop-blur-xl border-2 border-[color:var(--dark)] shadow-[8px_8px_0px_var(--dark)] rounded-[32px] p-8">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <label for="name" class="block text-sm font-bold text-[color:var(--dark)] mb-2 uppercase tracking-widest">Nama Kategori</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
                           class="w-full bg-white border-2 border-[color:var(--dark)] rounded-2xl px-5 py-3 font-bold text-[color:var(--dark)] shadow-[4px_4px_0px_var(--dark)] focus:outline-none focus:translate-y-[2px] focus:translate-x-[2px] focus:shadow-[2px_2px_0px_var(--dark)] transition-all">
                    @error('name')
                        <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex justify-end mt-8 pt-6 border-t-2 border-[color:var(--dark)]/10">
                    <button type="submit" class="btn-genz !py-3 !px-8">
                        Perbarui Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
