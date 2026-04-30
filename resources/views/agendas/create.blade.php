@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto relative z-10">
        
        {{-- Breadcrumb & Header --}}
        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4 relative z-10">
            <div>
                <a href="{{ route('agendas.index') }}" class="group inline-flex items-center text-sm font-bold text-[color:var(--brick)] hover:text-[color:var(--dark)] transition-colors mb-2">
                </a>
                <h2 class="text-3xl font-extrabold text-[color:var(--dark)] tracking-tight">Buat Agenda Baru</h2>
                <p class="text-[color:var(--dark)]/60 font-bold text-sm">Sistem Informasi Agenda - SMK Negeri 1 Cimahi</p>
            </div>
        </div>

        {{-- Main Form Card --}}
        <div class="bg-white border-4 border-[color:var(--dark)] shadow-[12px_12px_0px_var(--dark)] rounded-[40px] p-8 md:p-12">
            <form action="{{ route('agendas.store') }}" method="POST" class="relative z-10">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">
                    
                    {{-- Judul --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-extrabold text-[var(--dark)] mb-3 uppercase tracking-widest">Judul Agenda <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Uji Kompetensi Keahlian (UKK)"
                            class="w-full bg-white border-2 border-[color:var(--dark)] rounded-2xl px-5 py-4 font-bold text-[color:var(--dark)] shadow-[4px_4px_0px_var(--dark)] focus:outline-none focus:translate-y-[2px] focus:translate-x-[2px] focus:shadow-[2px_2px_0px_var(--dark)] transition-all @error('title') border-red-500 @enderror">
                        @error('title') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                    </div>

                    {{-- Kategori --}}
                    <div>
                        <label class="block text-sm font-extrabold text-[var(--dark)] mb-3 uppercase tracking-widest">Kategori</label>
                        <select name="category_id" required class="w-full bg-white border-2 border-[color:var(--dark)] rounded-2xl px-5 py-4 font-bold text-[color:var(--dark)] shadow-[4px_4px_0px_var(--dark)] focus:outline-none focus:translate-y-[2px] focus:translate-x-[2px] focus:shadow-[2px_2px_0px_var(--dark)] transition-all cursor-pointer">
                            <option value="" disabled selected>Pilih Kategori...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-sm font-extrabold text-[var(--dark)] mb-3 uppercase tracking-widest">Status Awal</label>
                        <select name="status" class="w-full bg-white border-2 border-[color:var(--dark)] rounded-2xl px-5 py-4 font-bold text-[color:var(--dark)] shadow-[4px_4px_0px_var(--dark)] focus:outline-none focus:translate-y-[2px] focus:translate-x-[2px] focus:shadow-[2px_2px_0px_var(--dark)] transition-all cursor-pointer">
                            <option value="mendatang">Mendatang</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>

                    {{-- Waktu --}}
                    <div>
                        <label class="block text-sm font-extrabold text-[var(--dark)] mb-3 uppercase tracking-widest">Waktu Mulai</label>
                        <input type="datetime-local" name="start_date" value="{{ request('date') ? request('date').'T08:00' : '' }}" required class="w-full bg-white border-2 border-[color:var(--dark)] rounded-2xl px-5 py-4 font-bold text-[color:var(--dark)] shadow-[4px_4px_0px_var(--dark)] focus:outline-none focus:translate-y-[2px] focus:translate-x-[2px] focus:shadow-[2px_2px_0px_var(--dark)] transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-extrabold text-[var(--dark)] mb-3 uppercase tracking-widest">Waktu Selesai</label>
                        <input type="datetime-local" name="end_date" value="{{ request('date') ? request('date').'T15:00' : '' }}" required class="w-full bg-white border-2 border-[color:var(--dark)] rounded-2xl px-5 py-4 font-bold text-[color:var(--dark)] shadow-[4px_4px_0px_var(--dark)] focus:outline-none focus:translate-y-[2px] focus:translate-x-[2px] focus:shadow-[2px_2px_0px_var(--dark)] transition-all">
                    </div>

                    {{-- Lokasi --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-extrabold text-[var(--dark)] mb-3 uppercase tracking-widest">Lokasi Kegiatan</label>
                        <input type="text" name="location" placeholder="R. Teori 1 / Lab RPL" required 
                            class="w-full bg-white border-2 border-[color:var(--dark)] rounded-2xl px-5 py-4 font-bold text-[color:var(--dark)] shadow-[4px_4px_0px_var(--dark)] focus:outline-none focus:translate-y-[2px] focus:translate-x-[2px] focus:shadow-[2px_2px_0px_var(--dark)] transition-all">
                    </div>

                    {{-- Deskripsi --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-extrabold text-[var(--dark)] mb-3 uppercase tracking-widest">Deskripsi Lengkap</label>
                        <textarea name="description" rows="4" placeholder="Tuliskan rincian kegiatan..."
                            class="w-full bg-white border-2 border-[color:var(--dark)] rounded-2xl px-5 py-4 font-bold text-[color:var(--dark)] shadow-[4px_4px_0px_var(--dark)] focus:outline-none focus:translate-y-[2px] focus:translate-x-[2px] focus:shadow-[2px_2px_0px_var(--dark)] transition-all resize-none"></textarea>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="mt-12 flex justify-end">
                    <button type="submit" class="btn-genz !py-4 !px-10 text-sm">
                         Simpan Agenda
                    </button>
                </div>
            </form>
        </div>

        {{-- Watermark --}}
        <p class="mt-8 text-center text-[color:var(--dark)]/30 text-[10px] font-bold uppercase tracking-[0.3em]">
            Sistem Informasi Agenda - SMK Negeri 1 Cimahi
        </p>
    </div>
@endsection