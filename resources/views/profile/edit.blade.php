@extends('layouts.app')

@section('content')
    <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6 relative z-10">
        <div>
            <h2 class="text-4xl font-black text-[color:var(--dark)] tracking-tighter uppercase italic">{{ __('Profil Pengguna') }}</h2>
            <p class="text-[color:var(--dark)]/60 font-bold text-sm mt-2 uppercase tracking-widest text-[10px]">Pusat Kendali Keamanan & Identitas Akun</p>
        </div>
    </div>

    <div class="pb-12">
        <div class="grid grid-cols-1 gap-12">
            <!-- Update Profile Section -->
            <div class="bg-[color:var(--krem)] p-10 rounded-[40px] border-4 border-[color:var(--dark)] shadow-[12px_12px_0px_var(--dark)] relative overflow-hidden group">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-[color:var(--orange)] rounded-full opacity-20 group-hover:scale-110 transition-transform"></div>
                <div class="max-w-2xl relative z-10">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password Section -->
            <div class="bg-blue-50 p-10 rounded-[40px] border-4 border-[color:var(--dark)] shadow-[12px_12px_0px_var(--dark)] relative overflow-hidden group">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-blue-200 rounded-full opacity-30 group-hover:scale-110 transition-transform"></div>
                <div class="max-w-2xl relative z-10">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account Section -->
            <div class="bg-red-50 p-10 rounded-[40px] border-4 border-[color:var(--dark)] shadow-[12px_12px_0px_var(--brick)] relative overflow-hidden group">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-red-200 rounded-full opacity-30 group-hover:scale-110 transition-transform"></div>
                <div class="max-w-2xl relative z-10">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
