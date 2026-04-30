@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10 relative z-10">
        <div>
            <h1 class="text-3xl font-extrabold text-[color:var(--dark)] tracking-tight">Manajemen Agenda</h1>
            <p class="text-[color:var(--dark)]/60 font-bold mt-1">Kelola semua jadwal dan kegiatan sekolah di satu tempat.</p>
        </div>
        @hasanyrole('administrator|guru/staff')
        <div>
            <a href="{{ route('agendas.create') }}" class="btn-genz !py-3 !px-7 !text-xs !shadow-[5px_5px_0px_var(--dark)]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                Tambah Agenda Baru
            </a>
        </div>
        @endhasanyrole
    </div>

    <form method="GET" action="{{ route('agendas.index') }}" class="bg-white p-6 rounded-[32px] border-4 border-[color:var(--dark)] shadow-[8px_8px_0px_var(--dark)] mb-12 flex flex-col lg:flex-row gap-6 relative z-10">
        <div class="relative flex-1">
            <span class="absolute inset-y-0 left-4 flex items-center text-slate-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </span>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari agenda (tekan enter)..." class="w-full pl-12 pr-4 py-3 bg-white border-slate-100 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 font-medium text-slate-600 transition-all">
        </div>
        <div class="flex gap-3">
            <div class="relative">
                <select name="category" onchange="this.form.submit()" class="appearance-none pl-5 pr-12 py-3 bg-white border-2 border-[color:var(--dark)] text-[color:var(--dark)] font-bold rounded-xl focus:ring-2 focus:ring-[color:var(--dark)] outline-none cursor-pointer shadow-[2px_2px_0px_var(--dark)]">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                <span class="absolute inset-y-0 right-4 flex items-center text-[color:var(--dark)] pointer-events-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </span>
            </div>
            <a href="{{ route('agendas.print', request()->all()) }}" target="_blank" class="btn-genz !bg-[#839755] !py-2 !px-5 !text-[11px] !shadow-[3px_3px_0px_var(--dark)] flex items-center justify-center gap-2 hover:!bg-[#fbb440] shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                Cetak PDF
            </a>
        </div>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
        @forelse($agendas as $agenda)
        <div class="agenda-card p-8 flex flex-col shadow-sm">
            <div class="flex justify-between items-start mb-6">
                <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest 
                    {{ $agenda->status == 'selesai' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' }}">
                    {{ $agenda->category->name ?? 'General' }}
                </span>
                @if(Auth::user()->hasRole('administrator') || (Auth::user()->hasRole('guru/staff') && $agenda->user_id == Auth::id()))
                <div class="flex gap-1">
                    <a href="{{ route('agendas.edit', $agenda->id) }}" class="p-2 text-slate-400 hover:text-blue-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    </a>
                    <form action="{{ route('agendas.destroy', $agenda->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button class="p-2 text-slate-400 hover:text-red-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>
                @endif
            </div>

            <h3 class="text-xl font-extrabold text-slate-800 mb-3 leading-tight">{{ $agenda->title }}</h3>
            <p class="text-slate-500 text-sm font-medium leading-relaxed mb-8 line-clamp-3">
                {{ $agenda->description }}
            </p>

            <div class="mt-auto space-y-4 pt-6 border-t border-slate-50">
                <div class="flex items-center gap-4 text-slate-400">
                    <div class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <span class="text-xs font-bold text-slate-600">{{ \Carbon\Carbon::parse($agenda->start_date)->format('Y-m-d') }}</span>
                </div>
                <div class="flex items-center gap-4 text-slate-400">
                    <div class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <span class="text-xs font-bold text-slate-600 line-clamp-1">{{ $agenda->location }}</span>
                </div>
            </div>

            <div class="mt-8 flex justify-between items-center">
                <span class="text-[10px] font-black uppercase tracking-tighter {{ $agenda->status == 'selesai' ? 'text-emerald-500' : 'text-blue-600' }}">
                    {{ strtoupper($agenda->status) }}
                </span>
                <a href="{{ route('agendas.show', $agenda->id) }}" class="text-xs font-black text-[color:var(--brick)] hover:text-orange-600 transition-colors group flex items-center gap-1">
                    Detail
                    <svg class="w-3 h-3 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full py-20 text-center">
            <div class="w-20 h-20 bg-slate-100 rounded-3xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <h3 class="text-xl font-bold text-slate-800">Belum Ada Agenda</h3>
            <p class="text-slate-500 font-medium">Mulai dengan menambahkan agenda kegiatan sekolah baru.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection