@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto relative z-10">
        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4 relative z-10">
            <div>
                <a href="{{ route('agendas.index') }}" class="group inline-flex items-center text-sm font-bold text-[color:var(--brick)] hover:text-[color:var(--dark)] transition-colors mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Batal dan Kembali
                </a>
                <h2 class="text-3xl font-extrabold text-[color:var(--dark)] tracking-tight">Edit Agenda</h2>
                <p class="text-[color:var(--dark)]/60 font-bold text-sm">Perbarui informasi agenda: <span class="font-bold text-[color:var(--brick)]">{{ $agenda->title }}</span></p>
            </div>
        </div>

        <div class="bg-white border-4 border-[color:var(--dark)] shadow-[12px_12px_0px_var(--dark)] rounded-[40px] p-8 md:p-12">
            <form action="{{ route('agendas.update', $agenda->id) }}" method="POST" class="relative z-10">
                @csrf
                @method('PUT') 
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">
                    
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-extrabold text-[var(--dark)] mb-3 uppercase tracking-widest">Judul Kegiatan <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title', $agenda->title) }}" required 
                            class="w-full bg-white border-2 border-[color:var(--dark)] rounded-2xl px-5 py-4 font-bold text-[color:var(--dark)] shadow-[4px_4px_0px_var(--dark)] focus:outline-none focus:translate-y-[2px] focus:translate-x-[2px] focus:shadow-[2px_2px_0px_var(--dark)] transition-all @error('title') border-red-500 @enderror">
                        @error('title') <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-extrabold text-[var(--dark)] mb-3 uppercase tracking-widest">Kategori Agenda</label>
                        <select name="category_id" id="category_id" class="w-full bg-white border-2 border-[color:var(--dark)] rounded-2xl px-5 py-4 font-bold text-[color:var(--dark)] shadow-[4px_4px_0px_var(--dark)] focus:outline-none focus:translate-y-[2px] focus:translate-x-[2px] focus:shadow-[2px_2px_0px_var(--dark)] transition-all cursor-pointer">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $agenda->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-extrabold text-[var(--dark)] mb-3 uppercase tracking-widest">Status Agenda</label>
                        <select name="status" id="status" class="w-full bg-white border-2 border-[color:var(--dark)] rounded-2xl px-5 py-4 font-bold text-[color:var(--dark)] shadow-[4px_4px_0px_var(--dark)] focus:outline-none focus:translate-y-[2px] focus:translate-x-[2px] focus:shadow-[2px_2px_0px_var(--dark)] transition-all cursor-pointer">
                            <option value="mendatang" {{ old('status', $agenda->status) == 'mendatang' ? 'selected' : '' }}>Mendatang</option>
                            <option value="sedang berlangsung" {{ old('status', $agenda->status) == 'sedang berlangsung' ? 'selected' : '' }}>Sedang Berlangsung</option>
                            <option value="selesai" {{ old('status', $agenda->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div>
                        <label for="start_date" class="block text-sm font-extrabold text-[var(--dark)] mb-3 uppercase tracking-widest">Waktu Mulai <span class="text-red-500">*</span></label>
                        <input type="datetime-local" name="start_date" id="start_date" 
                            value="{{ old('start_date', date('Y-m-d\TH:i', strtotime($agenda->start_date))) }}" required
                            class="w-full bg-white border-2 border-[color:var(--dark)] rounded-2xl px-5 py-4 font-bold text-[color:var(--dark)] shadow-[4px_4px_0px_var(--dark)] focus:outline-none focus:translate-y-[2px] focus:translate-x-[2px] focus:shadow-[2px_2px_0px_var(--dark)] transition-all">
                    </div>

                    <div>
                        <label for="end_date" class="block text-sm font-extrabold text-[var(--dark)] mb-3 uppercase tracking-widest">Waktu Selesai <span class="text-red-500">*</span></label>
                        <input type="datetime-local" name="end_date" id="end_date" 
                            value="{{ old('end_date', date('Y-m-d\TH:i', strtotime($agenda->end_date))) }}" required
                            class="w-full bg-white border-2 border-[color:var(--dark)] rounded-2xl px-5 py-4 font-bold text-[color:var(--dark)] shadow-[4px_4px_0px_var(--dark)] focus:outline-none focus:translate-y-[2px] focus:translate-x-[2px] focus:shadow-[2px_2px_0px_var(--dark)] transition-all">
                    </div>

                    <div class="md:col-span-2">
                        <label for="location" class="block text-sm font-extrabold text-[var(--dark)] mb-3 uppercase tracking-widest">Lokasi / Tempat <span class="text-red-500">*</span></label>
                        <input type="text" name="location" id="location" value="{{ old('location', $agenda->location) }}" required
                            class="w-full bg-white border-2 border-[color:var(--dark)] rounded-2xl px-5 py-4 font-bold text-[color:var(--dark)] shadow-[4px_4px_0px_var(--dark)] focus:outline-none focus:translate-y-[2px] focus:translate-x-[2px] focus:shadow-[2px_2px_0px_var(--dark)] transition-all">
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-extrabold text-[var(--dark)] mb-3 uppercase tracking-widest">Deskripsi Kegiatan</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full bg-white border-2 border-[color:var(--dark)] rounded-2xl px-5 py-4 font-bold text-[color:var(--dark)] shadow-[4px_4px_0px_var(--dark)] focus:outline-none focus:translate-y-[2px] focus:translate-x-[2px] focus:shadow-[2px_2px_0px_var(--dark)] transition-all resize-none">{{ old('description', $agenda->description) }}</textarea>
                    </div>
                </div>

                <div class="mt-12 flex flex-col sm:flex-row justify-end items-center gap-4">
                    <a href="{{ route('agendas.index') }}" class="btn-genz !bg-white !text-[color:var(--dark)] !shadow-[4px_4px_0px_var(--dark)] hover:!bg-slate-100 !py-4 !px-8 text-sm">
                        Batal
                    </a>
                    <button type="submit" class="btn-genz !py-4 !px-10 text-sm">
                         Perbarui Agenda
                    </button>
                </div>
            </form>
        </div>

        <p class="mt-8 text-center text-[color:var(--dark)]/30 text-[10px] font-bold uppercase tracking-[0.3em]">
            Sistem Informasi Agenda - SMK Negeri 1 Cimahi
        </p>
    </div>
@endsection