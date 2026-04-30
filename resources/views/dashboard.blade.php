@extends('layouts.app')

@section('content')
<div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4 relative z-10">
    <div>
        <h2 class="text-3xl font-black text-[color:var(--dark)] tracking-tight">Ringkasan Sistem</h2>
        <p class="text-[color:var(--dark)]/60 font-bold text-sm mt-1 uppercase tracking-wider text-[10px]">Laporan Aktivitas SMK Negeri 1 Cimahi</p>
    </div>
    @hasanyrole('administrator|guru/staff')
    <a href="{{ route('agendas.create') }}" class="btn-genz !py-3 !px-7 !text-[11px] !shadow-[5px_5px_0px_var(--dark)]">
        Tambah Agenda
    </a>
    @endhasanyrole
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
    @php 
        $stats = [
            ['label' => 'Total Agenda', 'value' => $totalAgenda, 'color' => 'blue', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
            ['label' => 'Minggu Ini', 'value' => $mingguIni, 'color' => 'amber', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['label' => 'Selesai', 'value' => $selesai, 'color' => 'emerald', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['label' => 'Mendatang', 'value' => $eventAktif, 'color' => 'rose', 'icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6'],
        ];
    @endphp

    @foreach($stats as $stat)
    <div class="bg-white p-7 rounded-[32px] border-2 border-[color:var(--dark)] shadow-[8px_8px_0px_var(--dark)] transition-all hover:translate-y-[-4px] hover:translate-x-[-4px] hover:shadow-[12px_12px_0px_var(--brick)] group">
        <div class="w-12 h-12 bg-{{ $stat['color'] }}-100 text-{{ $stat['color'] }}-700 rounded-xl flex items-center justify-center mb-6 border-2 border-[color:var(--dark)] shadow-[4px_4px_0px_var(--dark)] group-hover:scale-110 transition-transform">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"/></svg>
        </div>
        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $stat['label'] }}</p>
        <h3 class="text-3xl font-black text-slate-800 mt-2 tracking-tighter">{{ $stat['value'] }}</h3>
    </div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 bg-white p-8 rounded-[40px] border-2 border-[color:var(--dark)] shadow-[12px_12px_0px_var(--dark)]">
        <div class="flex justify-between items-center mb-12">
            <h4 class="font-extrabold text-[color:var(--dark)] text-2xl tracking-tight">Statistik Aktivitas</h4>
            <div class="flex gap-4">
                <span class="flex items-center text-[10px] font-bold text-[color:var(--dark)] uppercase tracking-widest"><span class="w-2 h-2 bg-[color:var(--brick)] rounded-full mr-2"></span> Padat</span>
            </div>
        </div>
        <div class="flex items-end justify-between gap-5 h-64 px-4">
            @foreach($chartHeights as $h)
            <div class="flex-1 bg-white border-2 border-[color:var(--dark)] rounded-t-xl relative group cursor-pointer overflow-hidden shadow-[4px_4px_0px_var(--dark)]" style="height: {{ max($h, 10) }}%">
                <div class="absolute inset-x-0 bottom-0 bg-[color:var(--orange)] border-t-2 border-[color:var(--dark)] transition-all duration-700 h-1/4 group-hover:h-full"></div>
            </div>
            @endforeach
        </div>
        <div class="flex justify-between mt-8 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-[3px]">
            @foreach($chartLabels as $label)
            <span>{{ substr($label, 0, 3) }}</span>
            @endforeach
        </div>
    </div>

    <div class="bg-white p-8 rounded-[40px] border-2 border-[color:var(--dark)] shadow-[12px_12px_0px_var(--brick)] flex flex-col">
        <h4 class="font-extrabold text-[color:var(--dark)] text-2xl mb-10 tracking-tight">Agenda Terdekat</h4>
        <div class="space-y-8 flex-1">
            @forelse($agendasMendatang as $ag)
            <div class="flex items-start gap-5 group cursor-pointer">
                <div class="w-12 h-12 bg-white text-[color:var(--dark)] rounded-xl flex flex-col items-center justify-center shrink-0 border-2 border-[color:var(--dark)] shadow-[3px_3px_0px_var(--dark)] group-hover:bg-[color:var(--orange)] transition-all">
                    <span class="text-sm font-black leading-none">{{ date('d', strtotime($ag->start_date)) }}</span>
                    <span class="text-[9px] font-black uppercase mt-1">{{ date('M', strtotime($ag->start_date)) }}</span>
                </div>
                <div class="flex-1 border-b-2 border-slate-100 pb-5 group-last:border-none">
                    <p class="text-base font-bold text-[color:var(--dark)] leading-tight group-hover:text-[color:var(--brick)] transition-colors">{{ $ag->title }}</p>
                    <p class="text-[10px] font-bold text-[color:var(--dark)]/60 uppercase mt-2 tracking-wider">{{ date('H:i', strtotime($ag->start_date)) }} WIB • {{ $ag->location }}</p>
                </div>
            </div>
            @empty
            <div class="flex flex-col items-center justify-center py-12 opacity-20">
                <p class="text-[10px] font-bold uppercase tracking-[2px]">Data Kosong</p>
            </div>
            @endforelse
        </div>
        <a href="{{ route('agendas.index') }}" class="btn-genz w-full text-center mt-10 !py-4">
            Semua Agenda
        </a>
    </div>
</div>
@endsection