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
            --dark: #2A360D;
            --krem: #fdfbf6;
            --brick: #9a2b0a;
            --orange: #fbb440;
        }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--krem);
        }
        .hero-mesh {
            position: relative;
            background-color: var(--dark);
            background-image: url('{{ asset('img/smk.jpg') }}');
            background-size: cover;
            background-position: center;
            background-blend-mode: multiply;
        }
        .hero-mesh::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(42, 54, 13, 0.45); /* Lebih transparan agar foto SMK terlihat jelas */
            z-index: 1;
        }
        .auth-card {
            background: rgba(253, 251, 246, 0.75); /* var(--krem) dengan transparansi */
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 3px solid var(--dark);
            box-shadow: 12px 12px 0px var(--dark);
            position: relative;
            z-index: 10;
        }
        .btn-genz {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 1rem 2rem;
            background-color: var(--dark);
            color: var(--krem);
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            border: 3px solid var(--dark);
            border-radius: 1rem;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }
        .btn-genz:hover {
            transform: translate(-4px, -4px);
            box-shadow: 8px 8px 0px var(--brick);
            background-color: var(--orange);
            color: var(--dark);
        }
        .btn-genz:active {
            transform: translate(0px, 0px);
            box-shadow: 0px 0px 0px var(--brick);
        }
        .input-genz {
            width: 100%;
            padding: 1rem 1.25rem;
            background-color: rgba(255, 255, 255, 0.9);
            border: 2px solid var(--dark);
            border-radius: 1rem;
            font-weight: 600;
            color: var(--dark);
            box-shadow: 4px 4px 0px rgba(42,54,13,0.1);
            transition: all 0.2s;
        }
        .input-genz:focus {
            outline: none;
            border-color: var(--brick);
            box-shadow: 4px 4px 0px var(--brick);
        }
    </style>
</head>
<body class="antialiased overflow-x-hidden">

    <div class="hero-mesh min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 relative">
        
        <div class="sm:mx-auto sm:w-full sm:max-w-md z-10 text-center mb-4">
            <div class="flex flex-col items-center">
                <a href="/" class="group">
                    <div class="w-20 h-20 transform transition group-hover:scale-110 duration-500 mb-4 drop-shadow-2xl">
                        <img src="{{ asset('img/logo_smk.png') }}" alt="Logo SMK" class="w-full h-full object-contain">
                    </div>
                </a>
                
                {{-- Slot Header dari Login/Register --}}
                <div class="space-y-1">
                    {{ $header ?? '' }}
                </div>
            </div>
        </div>

        <div class="mt-4 sm:mx-auto sm:w-full sm:max-w-[440px] z-10 px-4">
            <div class="auth-card py-10 px-6 shadow-[0_32px_64px_-15px_rgba(0,0,0,0.3)] sm:rounded-[40px] sm:px-12">
                {{ $slot }}
            </div>
            
            <div class="mt-10 text-center">
                <p class="text-[10px] text-blue-100/40 font-black uppercase tracking-[5px]">
                    SIAgenda &bull; Official Digital System &bull; 2026
                </p>
                <p class="mt-2 text-[9px] text-white/20 font-medium uppercase tracking-[2px]">
                    SMK Negeri 1 Cimahi
                </p>
            </div>
        </div>

    </div>

</body>
</html>