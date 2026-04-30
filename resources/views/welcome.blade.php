<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIAgenda - SMKN 1 Cimahi</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --olive: #839755;
            --cream: #ffe797;
            --orange: #fbb440;
            --brick: #9a2b0a;
            --dark: #2A360D;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: #fdfbf6;
            margin: 0;
            overflow-x: hidden;
            min-height: 100vh;
            color: var(--dark);
        }

        /* --- GRAINY OVERLAY --- */
        .grainy-layer {
            position: fixed;
            inset: 0;
            z-index: 100;
            pointer-events: none;
            opacity: 0.05;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
        }

        /* --- ANIMATED GEOMETRIC SHAPES --- */
        .shape {
            position: absolute;
            z-index: 1;
            filter: blur(2px); /* Blur sedikit biar tetep dapet shapenya */
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

        /* --- LAYOUT POSITIONS --- */
        .container-full {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 40px;
            position: relative;
            z-index: 10;
        }

        /* --- ULTRA GLASSMORPHISM (Perhatikan Komposisi Putihnya) --- */
        .glass-panel {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(30px) saturate(150%);
            -webkit-backdrop-filter: blur(30px) saturate(150%);
            border: 2px solid rgba(255, 255, 255, 0.7);
            border-radius: 60px;
            padding: 80px 60px;
            box-shadow: 0 40px 100px -20px rgba(42, 54, 13, 0.15);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
        }

        /* --- BRANDING BOLD REDESIGN --- */
        .logo-box {
            background: white;
            padding: 12px;
            border-radius: 24px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            display: inline-block;
        }

        .brand-text {
            font-size: 2.5rem;
            font-weight: 900;
            letter-spacing: -0.05em;
            text-transform: uppercase;
            font-style: italic;
        }

        .brand-accent {
            color: var(--brick);
            text-shadow: 4px 4px 0px var(--cream);
        }

        /* --- TYPOGRAPHY HERO --- */
        .h-super {
            font-size: clamp(3.5rem, 8vw, 7rem);
            font-weight: 900;
            line-height: 0.85;
            letter-spacing: -0.07em;
            margin-bottom: 30px;
        }

        /* --- BUTTONS 3D GEN Z --- */
        .btn-genz {
            padding: 22px 50px;
            background: var(--brick);
            color: white;
            border-radius: 25px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 3px solid var(--dark);
            box-shadow: 10px 10px 0px var(--dark);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 15px;
        }

        .btn-genz:hover {
            transform: translate(-4px, -4px);
            box-shadow: 14px 14px 0px var(--dark);
            background: var(--orange);
            color: var(--dark);
        }

        .btn-genz:active {
            transform: translate(6px, 6px);
            box-shadow: 0px 0px 0px var(--dark);
        }

        .preview-img-box {
            position: relative;
            background: rgba(255,255,255,0.3);
            padding: 20px;
            border-radius: 50px;
            border: 2px solid white;
            transform: rotate(2deg);
        }
    </style>
</head>
<body class="antialiased">
    <div class="grainy-layer"></div>

    <div class="shape circle-red"></div>
    <div class="shape capsule-olive"></div>
    <div class="shape square-orange"></div>

    <div class="container-full">
        <nav class="flex justify-between items-center mb-12 px-6">
            <div class="flex items-center gap-4">
                <div class="logo-box">
                    <img src="{{ asset('img/logo_smk.png') }}" class="w-12 h-12 object-contain">
                </div>
                <h1 class="brand-text">SI<span class="brand-accent">AGENDA</span></h1>
            </div>
            
            <div class="flex gap-6">
                <a href="{{ route('login') }}" class="font-black uppercase text-xs tracking-widest self-center text-dark/60 hover:text-brick transition-all">Log In</a>
                <a href="{{ route('register') }}" class="btn-genz !py-3 !px-7 !text-[10px] !shadow-[5px_5px_0px_var(--dark)]">Get Started</a>
            </div>
        </nav>

        <main class="glass-panel flex-1">
            <div class="lg:w-3/5" data-aos="fade-right">
                <div class="inline-flex items-center gap-3 px-6 py-2.5 bg-white rounded-full mb-10 border border-slate-100 shadow-sm">
                    <span class="w-3 h-3 bg-brick rounded-full animate-ping"></span>
                    <span class="text-dark font-black text-[11px] uppercase tracking-[5px]">Official SMKN 1 Cimahi</span>
                </div>

                <h1 class="h-super">
                    SMART <br> 
                    <span style="color: var(--olive);">AGENDA</span> <br>
                    <span class="brand-accent">TRACKING.</span>
                </h1>

                <p class="text-xl md:text-2xl font-bold text-dark/70 mb-14 leading-tight max-w-xl">
                    Solusi terpadu untuk mengelola jadwal, kegiatan, dan administrasi sekolah secara digital. 
                </p>

                <div class="flex gap-8">
                    <a href="{{ route('login') }}" class="btn-genz">
                        Mulai Sekarang
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
</div>
        </main>

        <footer class="mt-12 text-center">
            <p class="font-black uppercase tracking-[12px] text-[11px] opacity-20">SMK NEGERI 1 CIMAHI • 2026</p>
        </footer>
    </div>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 1000, once: true, easing: 'ease-in-out-back' });
    </script>
</body>
</html>