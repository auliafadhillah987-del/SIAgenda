@extends('layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10 relative z-10">
        <div>
            <h1 class="text-3xl font-extrabold text-[color:var(--dark)] tracking-tight">Manajemen Kategori</h1>
            <p class="text-[color:var(--dark)]/60 font-bold mt-1">Kelola label kategori untuk pengelompokan agenda sekolah.</p>
        </div>
        <div>
            <a href="{{ route('categories.create') }}" class="btn-genz !py-3 !px-7 !text-xs !shadow-[5px_5px_0px_var(--dark)]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                Tambah Kategori
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 px-6 py-4 bg-emerald-100 border-2 border-emerald-500 text-emerald-800 rounded-2xl font-bold shadow-[4px_4px_0px_#10b981]">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="mb-6 px-6 py-4 bg-rose-100 border-2 border-rose-500 text-rose-800 rounded-2xl font-bold shadow-[4px_4px_0px_#f43f5e]">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white border-4 border-[color:var(--dark)] shadow-[12px_12px_0px_var(--dark)] rounded-[40px] overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[color:var(--dark)] text-white">
                    <th class="p-5 font-black uppercase tracking-widest text-xs border-b-2 border-[color:var(--dark)]">No</th>
                    <th class="p-5 font-black uppercase tracking-widest text-xs border-b-2 border-[color:var(--dark)]">Nama Kategori</th>
                    <th class="p-5 font-black uppercase tracking-widest text-xs border-b-2 border-[color:var(--dark)]">Slug</th>
                    <th class="p-5 font-black uppercase tracking-widest text-xs border-b-2 border-[color:var(--dark)]">Jumlah Agenda</th>
                    <th class="p-5 font-black uppercase tracking-widest text-xs border-b-2 border-[color:var(--dark)] text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr class="border-b-2 border-[color:var(--dark)]/10 hover:bg-white/60 transition-colors">
                    <td class="p-5 font-bold text-[color:var(--dark)]">{{ $loop->iteration + $categories->firstItem() - 1 }}</td>
                    <td class="p-5 font-black text-lg text-[color:var(--brick)]">{{ $category->name }}</td>
                    <td class="p-5 font-bold text-[color:var(--dark)]/60"><span class="bg-white border-2 border-[color:var(--dark)] px-3 py-1 rounded-full text-xs shadow-[2px_2px_0px_var(--dark)]">{{ $category->slug }}</span></td>
                    <td class="p-5 font-bold text-[color:var(--dark)]">{{ $category->agendas_count }} Agenda</td>
                    <td class="p-5 text-center flex justify-center gap-2">
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn-genz !py-2 !px-4 !text-[10px] !shadow-[3px_3px_0px_var(--dark)]">Edit</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-genz !bg-red-600 !py-2 !px-4 !text-[10px] !shadow-[3px_3px_0px_var(--dark)] hover:!bg-red-700">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-8 text-center font-bold text-[color:var(--dark)]/50">Belum ada kategori yang ditambahkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @if($categories->hasPages())
        <div class="p-5 border-t-2 border-[color:var(--dark)] bg-white/50">
            {{ $categories->links() }}
        </div>
        @endif
    </div>
@endsection
