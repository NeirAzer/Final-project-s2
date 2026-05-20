<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Knote</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    },
                    colors: {
                        base: { light: '#FFFFFF', dark: '#050505' }
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                        'float': 'float 8s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-15px)' },
                        }
                    }
                }
            }
        }
    </script>
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <style>
        .ambient-mesh {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; pointer-events: none;
        }
        .ambient-mesh::before, .ambient-mesh::after {
            content: ''; position: absolute; border-radius: 50%; filter: blur(80px); opacity: 0.4; animation: float 10s ease-in-out infinite alternate;
        }
        .ambient-mesh::before {
            top: -10%; left: -10%; width: 50vw; height: 50vw; background: radial-gradient(circle, rgba(255, 113, 154, 0.2) 0%, transparent 70%);
        }
        .ambient-mesh::after {
            bottom: -10%; right: -10%; width: 50vw; height: 50vw; background: radial-gradient(circle, rgba(255, 199, 95, 0.15) 0%, transparent 70%); animation-delay: -5s;
        }
        .dark .ambient-mesh::before { background: radial-gradient(circle, rgba(124, 58, 237, 0.15) 0%, transparent 70%); }
        .dark .ambient-mesh::after { background: radial-gradient(circle, rgba(37, 99, 235, 0.1) 0%, transparent 70%); }
    </style>
</head>
<body class="bg-base-light text-gray-900 dark:bg-base-dark dark:text-gray-100 antialiased min-h-screen flex items-center justify-center p-6 selection:bg-gray-200 dark:selection:bg-gray-800">

    <div class="ambient-mesh"></div>

    <div class="absolute top-6 right-6">
        <button id="theme-toggle" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/50 dark:bg-black/50 border border-gray-200 dark:border-gray-800 text-gray-500 hover:text-gray-900 dark:hover:text-white transition-all backdrop-blur-sm cursor-pointer">
            <i id="theme-toggle-dark-icon" class="fa-solid fa-moon hidden text-sm"></i>
            <i id="theme-toggle-light-icon" class="fa-solid fa-sun hidden text-sm"></i>
        </button>
    </div>

    <div class="w-full max-w-md bg-white/70 dark:bg-[#0A0A0A]/70 backdrop-blur-xl border border-white/80 dark:border-gray-800/80 rounded-3xl p-8 sm:p-10 shadow-[0_20px_50px_rgba(0,0,0,0.05)] dark:shadow-[0_20px_50px_rgba(0,0,0,0.5)] animate-fade-in-up">
        
        <div class="text-center mb-8">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 mb-6 group">
                <span class="text-2xl font-bold tracking-tighter text-gray-900 dark:text-white">Knote</span>
            </a>
            <h1 class="text-2xl font-serif italic text-gray-900 dark:text-white mb-2">Buat Akun Baru</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 font-light">Bergabunglah dan mulai organisasi dokumentasi Anda.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            
            <div>
                <label for="name" class="block text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider mb-2">Nama Lengkap</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-800 bg-white/50 dark:bg-black/50 focus:ring-2 focus:ring-gray-900 dark:focus:ring-white focus:outline-none transition-all dark:text-white text-sm">
                @error('name')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider mb-2">Alamat Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-800 bg-white/50 dark:bg-black/50 focus:ring-2 focus:ring-gray-900 dark:focus:ring-white focus:outline-none transition-all dark:text-white text-sm">
                @error('email')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider mb-2">Kata Sandi</label>
                <input id="password" type="password" name="password" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-800 bg-white/50 dark:bg-black/50 focus:ring-2 focus:ring-gray-900 dark:focus:ring-white focus:outline-none transition-all dark:text-white text-sm">
                @error('password')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider mb-2">Konfirmasi Sandi</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-800 bg-white/50 dark:bg-black/50 focus:ring-2 focus:ring-gray-900 dark:focus:ring-white focus:outline-none transition-all dark:text-white text-sm">
            </div>

            <button type="submit" class="w-full py-3.5 mt-6 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-xl text-sm font-semibold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 cursor-pointer">
                Daftar Akun
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-500 dark:text-gray-400">
            Sudah memiliki akun? 
            <a href="{{ route('login') }}" class="font-semibold text-gray-900 dark:text-white hover:underline transition-all">Masuk di sini</a>
        </p>
    </div>

    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');

        if (document.documentElement.classList.contains('dark')) { lightIcon.classList.remove('hidden'); } 
        else { darkIcon.classList.remove('hidden'); }

        themeToggleBtn.addEventListener('click', function() {
            darkIcon.classList.toggle('hidden');
            lightIcon.classList.toggle('hidden');
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        });
    </script>
</body>
</html>