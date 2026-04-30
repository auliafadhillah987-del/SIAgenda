<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIAgenda - SMK Negeri 1 Cimahi</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 90px;
            --sidebar-bg: #9a2b0a; /* --brick */
            --accent-color: #fbb440; /* --orange */
            --olive: #839755;
            --cream: #ffe797;
            --orange: #fbb440;
            --brick: #9a2b0a;
            --dark: #2A360D;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif !important; 
            color: var(--dark) !important;
            margin: 0;
            background: #fdfbf6;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* --- GRAINY OVERLAY --- */
        .grainy-layer {
            position: fixed;
            inset: 0;
            z-index: -2;
            pointer-events: none;
            opacity: 0.05;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
        }

        /* --- ANIMATED GEOMETRIC SHAPES --- */
        .shape {
            position: fixed;
            z-index: -3;
            filter: blur(2px);
            animation: float-shapes 20s infinite alternate ease-in-out;
        }

        .circle-red {
            width: 350px; height: 350px;
            background: linear-gradient(135deg, var(--brick), var(--orange));
            border-radius: 50%;
            top: -100px; left: -50px;
        }

        .capsule-olive {
            width: 150px; height: 400px;
            background: var(--olive);
            border-radius: 100px;
            top: 20%; right: 5%;
            transform: rotate(-30deg);
            animation-delay: -5s;
        }

        .square-orange {
            width: 250px; height: 250px;
            background: var(--orange);
            bottom: -50px; left: 15%;
            border-radius: 40px;
            transform: rotate(15deg);
            animation-delay: -10s;
        }

        @keyframes float-shapes {
            0% { transform: translate(0, 0) rotate(0deg) scale(1); }
            50% { transform: translate(40px, 60px) rotate(10deg) scale(1.05); }
            100% { transform: translate(-20px, 30px) rotate(-5deg) scale(1); }
        }

        /* --- BUTTONS 3D GEN Z --- */
        .btn-genz {
            padding: 16px 30px;
            background: var(--brick);
            color: white !important;
            border-radius: 20px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 3px solid var(--dark);
            box-shadow: 6px 6px 0px var(--dark);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-genz:hover {
            transform: translate(-2px, -2px);
            box-shadow: 8px 8px 0px var(--dark);
            background: var(--orange);
            color: var(--dark) !important;
        }

        .btn-genz:active {
            transform: translate(4px, 4px);
            box-shadow: 0px 0px 0px var(--dark);
        }

        /* SIDEBAR MODERN NEO-BRUTALISM */
        .sidebar { 
            width: var(--sidebar-width); 
            background: var(--sidebar-bg); 
            position: fixed; 
            height: 100vh; 
            left: 0;
            top: 0;
            display: flex; 
            flex-direction: column; 
            border-right: 4px solid var(--dark);
            z-index: 50;
            transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            overflow: hidden;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        /* MAIN CONTENT ADJUSTMENT */
        .main-content { 
            margin-left: var(--sidebar-width); 
            transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .main-content.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* NAVBAR FULL WIDTH INTEGRATED */
        .top-navbar {
            background: #ffffff;
            border-bottom: 4px solid var(--dark);
            padding: 24px 40px;
            margin-bottom: 32px;
            position: sticky;
            top: 0;
            z-index: 40;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        /* NAV LINK DENGAN HOVER EFFECT NEO-BRUTALISM */
        .nav-link { 
            display: flex; 
            align-items: center; 
            padding: 14px 20px; 
            color: rgba(255, 255, 255, 0.8); 
            font-weight: 800; 
            border-radius: 16px; 
            margin: 4px 16px; 
            transition: all 0.2s ease; 
            font-size: 14px;
            white-space: nowrap;
            text-decoration: none;
            border: 2px solid transparent;
        }

        .nav-link:hover { 
            background: var(--orange); 
            color: var(--dark); 
            transform: translate(-3px, -3px);
            border: 2px solid var(--dark);
            box-shadow: 4px 4px 0px var(--dark);
        }

        .nav-link.active { 
            background: var(--cream); 
            color: var(--dark); 
            border: 2px solid var(--dark);
            box-shadow: 4px 4px 0px var(--dark);
            font-weight: 900;
        }

        .nav-link svg { width: 22px; height: 22px; flex-shrink: 0; transition: transform 0.3s; }
        .nav-link:hover svg { transform: scale(1.1); }
        .nav-link.active svg { color: #000000; }

        /* HIDING ELEMENTS ON COLLAPSE */
        .sidebar.collapsed .nav-text,
        .sidebar.collapsed .sidebar-header-text,
        .sidebar.collapsed .menu-label {
            opacity: 0;
            visibility: hidden;
            width: 0;
        }

        .sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 14px 0;
            margin: 4px 12px;
        }

        /* TOGGLE BUTTON CUSTOM NEO-BRUTALISM */
        .toggle-btn {
            background: white;
            border: 2px solid var(--dark);
            box-shadow: 4px 4px 0px var(--dark);
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #2A360D;
            transition: all 0.2s;
        }

        .toggle-btn:hover {
            background: var(--orange);
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px var(--dark);
        }
        
        .toggle-btn:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px var(--dark);
        }

        /* SEARCH BAR */
        .search-bar { 
            background: #f1f5f9; 
            border: 1px solid transparent; 
            border-radius: 14px; 
            padding: 12px 20px; 
            width: 350px; 
            font-size: 14px; 
            transition: all 0.3s;
        }

        .search-bar:focus { 
            background: white; 
            border-color: var(--accent-color); 
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1); 
            outline: none;
        }

        .content-body {
            padding: 0 40px 40px 40px;
            max-width: 1600px;
            margin: 0 auto;
        }
    
        /* Efek Card Neo-Brutalism */
        .agenda-card {
            background: #ffffff;
            border-radius: 24px;
            border: 3px solid var(--dark);
            box-shadow: 8px 8px 0px var(--dark);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
    
        .agenda-card:hover {
            transform: translate(-4px, -4px);
            box-shadow: 12px 12px 0px var(--dark);
        }

        /* Theme Toggle Button specific */
        .theme-toggle-btn {
            background: var(--bg-card);
            color: var(--dark);
            border: 2px solid var(--dark);
            box-shadow: 3px 3px 0px var(--dark);
            padding: 8px 12px;
            border-radius: 12px;
            font-weight: 900;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 11px;
            text-transform: uppercase;
        }

        .theme-toggle-btn:hover {
            transform: translate(-2px, -2px);
            box-shadow: 5px 5px 0px var(--dark);
            background: var(--orange);
        }
    </style>

    <script>
        // Check for saved theme preference or default to light
        const currentTheme = localStorage.getItem('theme') || 'light';
        if (currentTheme === 'dark') {
            document.documentElement.classList.add('dark-theme');
        }
    </script>
</head>
<body class="antialiased">
    <div class="grainy-layer"></div>
    <div class="shape circle-red"></div>
    <div class="shape capsule-olive"></div>
    <div class="shape square-orange"></div>

    <aside class="sidebar" id="sidebar">
        <div class="p-7 mb-4">
            <div class="flex items-center gap-4">
                <div class="w-11 h-11 bg-white rounded-xl p-2 border-2 border-[color:var(--dark)] shadow-[3px_3px_0px_var(--dark)] flex items-center justify-center flex-shrink-0">
                   <img src="{{ asset('img/logo_smk.png') }}" alt="Logo" class="w-full h-full object-contain">
                </div>
                <div class="sidebar-header-text transition-all duration-300">
                    <h1 class="text-lg font-extrabold tracking-tight text-white leading-none">SIAgenda</h1>
                    <span class="text-[9px] font-bold text-blue-100/70 uppercase tracking-widest">SMKN 1 Cimahi</span>
                </div>
            </div>
        </div>

        <nav class="flex-1">
            <p class="px-8 text-[10px] font-bold text-blue-200/50 uppercase tracking-[0.2em] mb-4 menu-label">Menu Utama</p>
            
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span class="nav-text ml-3">Dashboard</span>
            </a>
            
            <a href="{{ route('agendas.index') }}" class="nav-link {{ (request()->routeIs('agendas.*') && !request()->routeIs('agendas.calendar')) ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg> 
                <span class="nav-text ml-3">Agenda Sekolah</span>
            </a>

             <a href="{{ route('agendas.calendar') }}" class="nav-link {{ request()->routeIs('agendas.calendar') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg> 
                <span class="nav-text ml-3">Kalender</span>
            </a>

            @hasanyrole('administrator|guru/staff')
            <p class="px-8 mt-6 text-[10px] font-bold text-blue-200/50 uppercase tracking-[0.2em] mb-4 menu-label">Administrator</p>
            <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg> 
                <span class="nav-text ml-3">Kategori Agenda</span>
            </a>
            @endhasanyrole

            @role('administrator')
            <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg> 
                <span class="nav-text ml-3">Kelola Pengguna</span>
            </a>
            @endrole

            <p class="px-8 mt-6 text-[10px] font-bold text-blue-200/50 uppercase tracking-[0.2em] mb-4 menu-label">Pengaturan</p>
            <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg> 
                <span class="nav-text ml-3">Profil Pengguna</span>
            </a>
        </nav>

        <div class="p-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="group flex items-center justify-center lg:justify-start gap-3 w-full px-4 py-3 bg-white/10 text-white rounded-xl border-2 border-transparent hover:bg-white hover:border-[color:var(--dark)] hover:text-red-600 hover:shadow-[4px_4px_0px_var(--dark)] hover:-translate-y-1 hover:-translate-x-1 transition-all duration-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span class="nav-text font-black text-[11px] uppercase tracking-widest">Keluar Sesi</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="main-content" id="main-content">
        <header class="top-navbar">
            <div class="flex items-center gap-6">
                <button id="toggleSidebar" class="toggle-btn">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                </button>

                <div class="hidden lg:flex items-center gap-2 bg-white px-4 py-2 rounded-xl border-2 border-[color:var(--dark)] shadow-[3px_3px_0px_var(--dark)]">
                    <svg class="w-5 h-5 text-[color:var(--brick)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="text-[11px] font-black uppercase tracking-[1px] text-[#2A360D]">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-slate-800 leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-[color:var(--brick)] font-black mt-1 uppercase tracking-[2px]">
                        {{ Auth::user()->roles->first()->name ?? 'Staff' }}
                    </p>
                </div>
                <div class="w-11 h-11 bg-[color:var(--dark)] text-white rounded-xl flex items-center justify-center font-black text-xl uppercase shadow-[4px_4px_0px_var(--brick)] border-2 border-[color:var(--dark)]">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </header>

        <div class="content-body">
            @yield('content')
        </div>
    </main>

    <script>
        // Sidebar logic
        const btn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('main-content');

        btn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            main.classList.toggle('expanded');
        }); 
    </script>
</body>
</html>