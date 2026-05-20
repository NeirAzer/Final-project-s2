<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan (404) - Knote</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400;1,500&display=swap" rel="stylesheet">
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
            top: -10%; left: -10%; width: 50vw; height: 50vw; background: radial-gradient(circle, rgba(255, 113, 154, 0.15) 0%, transparent 70%);
        }
        .ambient-mesh::after {
            bottom: -10%; right: -10%; width: 50vw; height: 50vw; background: radial-gradient(circle, rgba(255, 199, 95, 0.1) 0%, transparent 70%); animation-delay: -5s;
        }
        .dark .ambient-mesh::before { background: radial-gradient(circle, rgba(124, 58, 237, 0.15) 0%, transparent 70%); }
        .dark .ambient-mesh::after { background: radial-gradient(circle, rgba(37, 99, 235, 0.1) 0%, transparent 70%); }

        .text-glow {
            text-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
        .dark .text-glow {
            text-shadow: 0 10px 40px rgba(255,255,255,0.1);
        }
    </style>
</head>
<body class="bg-base-light text-gray-900 dark:bg-base-dark dark:text-gray-100 antialiased min-h-screen flex items-center justify-center p-6 selection:bg-gray-200 dark:selection:bg-gray-800 relative overflow-hidden">

    <div class="ambient-mesh"></div>

    <div class="absolute top-6 left-6 md:top-8 md:left-10 z-20">
        <a href="{{ url('/') }}" class="flex items-center gap-2 group">
            <span class="text-xl font-bold tracking-tighter text-gray-900 dark:text-white">Knote</span>
        </a>
    </div>

    <div class="absolute top-6 right-6 md:top-8 md:right-10 z-20">
        <button id="theme-toggle" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/50 dark:bg-black/50 border border-gray-200 dark:border-gray-800 text-gray-500 hover:text-gray-900 dark:hover:text-white hover:bg-white dark:hover:bg-gray-900 transition-all backdrop-blur-sm shadow-sm cursor-pointer">
            <i id="theme-toggle-dark-icon" class="fa-solid fa-moon hidden text-sm"></i>
            <i id="theme-toggle-light-icon" class="fa-solid fa-sun hidden text-sm"></i>
        </button>
    </div>

    <div class="w-full max-w-3xl mx-auto text-center relative z-10 animate-fade-in-up">
        
        <h1 class="text-[8rem] sm:text-[12rem] md:text-[14rem] font-bold tracking-tighter leading-none bg-clip-text text-transparent bg-gradient-to-b from-gray-900 to-gray-300 dark:from-white dark:to-gray-800 select-none text-glow mb-2 md:-mb-6">
            404
        </h1>
        
        <h2 class="text-3xl md:text-5xl font-serif italic text-gray-900 dark:text-white mb-6">
            Halaman Tidak Ditemukan
        </h2>
        
        <p class="text-base md:text-lg text-gray-500 dark:text-gray-400 max-w-lg mx-auto mb-10 font-light leading-relaxed">
            Maaf, halaman atau dokumen yang Anda cari tidak dapat ditemukan. Mungkin telah dipindahkan, dihapus, atau Anda salah mengetikkan URL.
        </p>
        
        <a href="{{ url('/') }}" class="inline-flex items-center justify-center gap-3 w-full sm:w-auto py-4 px-10 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-full text-sm font-semibold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 cursor-pointer">
            <i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke Beranda
        </a>

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