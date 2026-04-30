<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - SIAgenda</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-gradient-blue {
            /* Gradasi Biru: Deep Blue ke Royal Blue */
            background: linear-gradient(135deg, #1E3A8A 0%, #3B82F6 100%);
        }
        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="bg-gradient-blue min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 relative overflow-hidden">

    <div class="absolute top-0 left-0 w-96 h-96 bg-white opacity-5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full translate-x-1/3 translate-y-1/3"></div>

    <div class="sm:mx-auto sm:w-full sm:max-w-md z-10 text-center">
        <div class="flex justify-center mb-6">
            <div class="w-32 h-32 transform transition hover:scale-110 duration-300">
                <img src="{{ asset('img/logo_smk.png') }}" alt="Logo SMK" class="w-full h-full object-contain">
            </div>
        </div>
        <h2 class="text-3xl font-extrabold text-white tracking-tight">
            Selamat Datang Kembali
        </h2>
        <p class="mt-2 text-sm text-blue-100 font-medium">
            Masuk untuk mengelola agenda sekolah kamu
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md z-10">
        <div class="auth-card py-10 px-6 shadow-2xl sm:rounded-[32px] sm:px-12">
            
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-blue-600 bg-blue-50 p-3 rounded-xl text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700">Email Address</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus 
                            class="appearance-none block w-full px-4 py-3 border border-slate-200 rounded-xl shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all bg-slate-50/50">
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700">Password</label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" required 
                            class="appearance-none block w-full px-4 py-3 border border-slate-200 rounded-xl shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all bg-slate-50/50">
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded-md">
                        <label for="remember_me" class="ml-2 block text-sm text-slate-600 font-medium">Ingat saya</label>
                    </div>

                    @if (Route::has('password.request'))
                    <div class="text-sm">
                        <a href="{{ route('password.request') }}" class="font-semibold text-blue-600 hover:text-blue-500 transition">
                            Lupa password?
                        </a>
                    </div>
                    @endif
                </div>

                <div>
                    <button type="submit" style="background: linear-gradient(135deg, #1E40AF 0%, #3B82F6 100%);" 
                        class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-2xl shadow-lg text-sm font-bold text-white hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all active:scale-[0.98]">
                        Masuk Sekarang
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-8 border-t border-slate-100 text-center">
                <p class="text-sm text-slate-500 font-medium">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:text-blue-500 transition">Daftar Akun Baru</a>
                </p>
            </div>
        </div>
        
        <p class="mt-8 text-center text-xs text-blue-100 font-bold uppercase tracking-widest">
            &copy; 2026 SMK NEGERI 1 CIMAHI
        </p>
    </div>

</body>
</html>