@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto py-8">
        <!-- Back and Actions Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-end md:justify-between gap-6 relative z-10">
            <div>
                <a href="{{ route('agendas.index') }}" class="group inline-flex items-center text-xs font-black uppercase tracking-widest text-[color:var(--brick)] hover:text-[color:var(--dark)] transition-all mb-4">
                </a>
                <h2 class="text-4xl font-black text-[color:var(--dark)] tracking-tighter uppercase italic">Detail Agenda</h2>
            </div>
            
            @if(Auth::user()->hasRole('administrator') || (Auth::user()->hasRole('guru/staff') && $agenda->user_id == Auth::id()))
            <div class="flex items-center gap-4">
                <a href="{{ route('agendas.edit', $agenda->id) }}" class="btn-genz !bg-[color:var(--olive)] !py-3 !px-6 !text-[11px] !shadow-[4px_4px_0px_var(--dark)] hover:!bg-[color:var(--orange)]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Ubah Agenda
                </a>
                <form action="{{ route('agendas.destroy', $agenda->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus agenda ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-genz !bg-red-500 !py-3 !px-6 !text-[11px] !shadow-[4px_4px_0px_var(--dark)] hover:!bg-red-600">
                        <svg class="h-4 w-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Hapus
                    </button>
                </form>
            </div>
            @endif
        </div>

        <!-- Main Card Container -->
        <div class="bg-white border-4 border-[color:var(--dark)] shadow-[12px_12px_0px_var(--dark)] rounded-[40px] overflow-hidden">
            <!-- Decorative Header Banner -->
            <div class="h-40 w-full bg-[color:var(--brick)] relative border-b-4 border-[color:var(--dark)] pattern-dots">
                <div class="absolute -bottom-6 left-12">
                    @if($agenda->status == 'mendatang')
                        <span class="px-8 py-3 bg-[color:var(--orange)] text-[color:var(--dark)] rounded-2xl text-xs font-black uppercase tracking-[3px] shadow-[6px_6px_0px_var(--dark)] border-4 border-[color:var(--dark)]">Mendatang</span>
                    @elseif($agenda->status == 'sedang berlangsung')
                        <span class="px-8 py-3 bg-[color:var(--olive)] text-white rounded-2xl text-xs font-black uppercase tracking-[3px] shadow-[6px_6px_0px_var(--dark)] border-4 border-[color:var(--dark)] animate-pulse">Berlangsung</span>
                    @else
                        <span class="px-8 py-3 bg-emerald-400 text-[color:var(--dark)] rounded-2xl text-xs font-black uppercase tracking-[3px] shadow-[6px_6px_0px_var(--dark)] border-4 border-[color:var(--dark)]">Selesai</span>
                    @endif
                </div>
            </div>

            <div class="p-12 pt-16">
                <div class="inline-block px-4 py-1.5 bg-[color:var(--dark)] text-[color:var(--krem)] text-[10px] font-black uppercase tracking-widest rounded-lg mb-4">
                    {{ $agenda->category->name ?? 'Kategori Umum' }}
                </div>
                <h1 class="text-5xl font-black text-[color:var(--dark)] mt-2 leading-[1.1] tracking-tighter">{{ $agenda->title }}</h1>
                
                <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Info Box 1 -->
                    <div class="p-6 bg-[color:var(--krem)] border-4 border-[color:var(--dark)] shadow-[6px_6px_0px_var(--dark)] rounded-3xl flex items-center gap-5">
                        <div class="w-14 h-14 bg-white border-2 border-[color:var(--dark)] rounded-2xl flex items-center justify-center text-[color:var(--dark)] shrink-0">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-[color:var(--dark)]/50 uppercase tracking-widest mb-1">Tanggal & Waktu</p>
                            <p class="text-lg font-black text-[color:var(--dark)] leading-none">{{ date('d F Y', strtotime($agenda->start_date)) }}</p>
                            <p class="text-sm font-bold text-[color:var(--brick)] mt-2">{{ date('H:i', strtotime($agenda->start_date)) }} — {{ date('H:i', strtotime($agenda->end_date)) }} WIB</p>
                        </div>
                    </div>

                    <!-- Info Box 2 -->
                    <div class="p-6 bg-blue-100 border-4 border-[color:var(--dark)] shadow-[6px_6px_0px_var(--dark)] rounded-3xl flex items-center gap-5">
                        <div class="w-14 h-14 bg-white border-2 border-[color:var(--dark)] rounded-2xl flex items-center justify-center text-[color:var(--dark)] shrink-0">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-[color:var(--dark)]/50 uppercase tracking-widest mb-1">Lokasi Kegiatan</p>
                            <p class="text-lg font-black text-[color:var(--dark)] leading-tight">{{ $agenda->location }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-12">
                    <h3 class="text-2xl font-black text-[color:var(--dark)] mb-6 flex items-center gap-3 italic">
                        <span class="w-10 h-1 bg-[color:var(--brick)] inline-block"></span>
                        Deskripsi Kegiatan
                    </h3>
                    <div class="text-[color:var(--dark)] text-lg font-medium leading-relaxed bg-slate-50 p-8 border-4 border-[color:var(--dark)] rounded-[32px] shadow-[8px_8px_0px_rgba(0,0,0,0.05)]">
                        {!! nl2br(e($agenda->description)) !!}
                    </div>
                </div>

                <div class="mt-12 p-6 bg-white border-2 border-[color:var(--dark)] rounded-2xl flex flex-wrap gap-8 justify-between">
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Penyelenggara</p>
                        <p class="text-sm font-black text-[color:var(--dark)]">{{ $agenda->user->name ?? 'Staff Sekolah' }}</p>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Terakhir Diperbarui</p>
                        <p class="text-sm font-black text-[color:var(--dark)]">{{ $agenda->updated_at->diffForHumans() }}</p>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
