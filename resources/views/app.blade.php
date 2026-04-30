<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIAgenda</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8FAFC; margin: 0; }
        .sidebar { width: 280px; background: white; border-right: 1px solid #F1F5F9; position: fixed; height: 100vh; z-index: 50; }
        .main-content { margin-left: 280px; padding: 40px; min-height: 100vh; }
        .nav-item { display: flex; align-items: center; padding: 12px 20px; color: #64748B; font-weight: 600; text-decoration: none; border-radius: 12px; margin-bottom: 8px; transition: 0.2s; }
        .nav-item:hover, .nav-item.active { background: #F5F7FF; color: #4F46E5; }
        .card-custom { background: white; border-radius: 24px; padding: 24px; border: 1px solid #F1F5F9; box-shadow: 0 2px 15px rgba(0,0,0,0.02); }
    </style>
</head>
<body>
    <aside class="sidebar p-8">
        <div class="flex items-center gap-3 mb-12">
            <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-indigo-100">S</div>
            <h1 class="text-xl font-extrabold text-slate-800 tracking-tighter">SIAgenda</h1>
        </div>

        <nav>
            <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="#" class="nav-item">Agenda Sekolah</a>
        </nav>

        <div class="absolute bottom-8 left-8 right-8 pt-6 border-t border-slate-50">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-500 font-bold text-sm hover:opacity-70 transition cursor-pointer bg-transparent border-none">Keluar Sesi</button>
            </form>
        </div>
    </aside>

    <main class="main-content">
        <header class="flex justify-between items-center mb-10">
            <h2 class="text-slate-400 font-bold text-xs uppercase tracking-widest">Dashboard Overview</h2>
            <div class="flex items-center gap-3">
                <span class="text-sm font-bold text-slate-700">{{ Auth::user()->name }}</span>
                <div class="w-10 h-10 bg-slate-200 rounded-full"></div>
            </div>
        </header>

        @yield('content')
    </main>
</body>
</html>