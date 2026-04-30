@extends('layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10 relative z-10">
        <div>
            <h1 class="text-3xl font-extrabold text-[color:var(--dark)] tracking-tight">Kelola Pengguna</h1>
            <p class="text-[color:var(--dark)]/60 font-bold mt-1">Atur peran dan hak akses pengguna sistem.</p>
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
                    <th class="p-5 font-black uppercase tracking-widest text-xs border-b-2 border-[color:var(--dark)]">Nama</th>
                    <th class="p-5 font-black uppercase tracking-widest text-xs border-b-2 border-[color:var(--dark)]">Email</th>
                    <th class="p-5 font-black uppercase tracking-widest text-xs border-b-2 border-[color:var(--dark)]">Role Saat Ini</th>
                    <th class="p-5 font-black uppercase tracking-widest text-xs border-b-2 border-[color:var(--dark)] text-center">Ubah Role</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr class="border-b-2 border-[color:var(--dark)]/10 hover:bg-white/60 transition-colors">
                    <td class="p-5 font-black text-lg text-[color:var(--brick)]">{{ $user->name }}</td>
                    <td class="p-5 font-bold text-[color:var(--dark)]/60">{{ $user->email }}</td>
                    <td class="p-5 font-bold text-[color:var(--dark)]/60">
                        @foreach($user->roles as $role)
                            <span class="bg-white border-2 border-[color:var(--dark)] px-3 py-1 rounded-full text-xs shadow-[2px_2px_0px_var(--dark)]">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td class="p-5 text-center">
                        <form action="{{ route('users.updateRole', $user->id) }}" method="POST" class="flex items-center justify-center gap-2">
                            @csrf
                            @method('PATCH')
                            <select name="role" class="bg-white border-2 border-[color:var(--dark)] rounded-xl px-3 py-2 font-bold text-[color:var(--dark)] shadow-[2px_2px_0px_var(--dark)] focus:outline-none text-xs">
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn-genz !py-2 !px-4 !text-[10px] !shadow-[2px_2px_0px_var(--dark)]">Update</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-8 text-center font-bold text-[color:var(--dark)]/50">Belum ada pengguna.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @if($users->hasPages())
        <div class="p-5 border-t-2 border-[color:var(--dark)] bg-white/50">
            {{ $users->links() }}
        </div>
        @endif
    </div>
@endsection
