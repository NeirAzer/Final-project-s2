<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Knote - Platform Catatan Minimalis')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400;1,500;1,600&display=swap" rel="stylesheet">
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
                        base: {
                            light: '#FFFFFF',
                            dark: '#050505',
                        },
                        surface: {
                            light: '#FAFAFA',
                            dark: '#0E0E0E',
                        }
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                        'float': 'float 8s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
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
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 1s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Latar Belakang Gradasi Halus ala SaaS Modern */
        .ambient-mesh {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
            pointer-events: none;
            background-color: transparent;
        }
        
        .ambient-mesh::before, .ambient-mesh::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.5;
            animation: float 10s ease-in-out infinite alternate;
        }

        .ambient-mesh::before {
            top: -10%;
            left: 15%;
            width: 60vw;
            height: 60vw;
            background: radial-gradient(circle, rgba(255, 113, 154, 0.3) 0%, rgba(255, 179, 138, 0.1) 50%, transparent 80%);
        }

        .ambient-mesh::after {
            bottom: -20%;
            right: 10%;
            width: 50vw;
            height: 50vw;
            background: radial-gradient(circle, rgba(255, 199, 95, 0.2) 0%, rgba(249, 248, 113, 0.1) 50%, transparent 80%);
            animation-delay: -5s;
        }

        .dark .ambient-mesh::before {
            background: radial-gradient(circle, rgba(124, 58, 237, 0.2) 0%, rgba(79, 70, 229, 0.1) 50%, transparent 80%);
        }

        .dark .ambient-mesh::after {
            background: radial-gradient(circle, rgba(37, 99, 235, 0.15) 0%, rgba(14, 165, 233, 0.1) 50%, transparent 80%);
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .dark .glass-nav {
            background: rgba(5, 5, 5, 0.7);
        }
    </style>
</head>
<body class="bg-base-light text-gray-900 dark:bg-base-dark dark:text-gray-100 antialiased selection:bg-gray-200 dark:selection:bg-gray-800 transition-colors duration-300 relative overflow-x-hidden">

    <div class="ambient-mesh"></div>

    <header class="fixed inset-x-0 top-0 z-50 glass-nav border-b border-gray-100/50 dark:border-gray-900/50 transition-colors">
        <nav class="flex items-center justify-between p-5 lg:px-12 max-w-7xl mx-auto">
            
            <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                <span class="text-xl font-bold tracking-tighter text-gray-900 dark:text-white">Knote</span>
            </a>
            
            <div class="hidden md:flex gap-x-12">
                <a href="#features" class="text-sm font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">Fitur</a>
            </div>

            <div class="flex items-center gap-5">
                <button id="theme-toggle" class="w-8 h-8 flex items-center justify-center rounded-full text-gray-400 hover:text-gray-900 hover:bg-gray-100 dark:hover:text-white dark:hover:bg-gray-800 transition-all">
                    <i id="theme-toggle-dark-icon" class="fa-solid fa-moon hidden text-sm"></i>
                    <i id="theme-toggle-light-icon" class="fa-solid fa-sun hidden text-sm"></i>
                </button>
                <a href="{{ route('login') }}" class="hidden sm:block text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="rounded-full px-6 py-2.5 text-sm font-semibold text-gray-900 border border-gray-200 hover:border-gray-900 hover:bg-gray-50 dark:text-white dark:border-gray-800 dark:hover:border-white dark:hover:bg-gray-900 transition-all shadow-sm">
                    Daftar Sekarang
                </a>
            </div>
        </nav>
    </header>

    <main>
        <section class="relative pt-40 pb-24 lg:pt-52 lg:pb-32 overflow-hidden flex flex-col items-center justify-center min-h-screen">
            <div class="max-w-5xl mx-auto px-6 text-center relative z-10">
                
                <div class="animate-fade-in-up">
                    <div class="inline-flex items-center px-3 py-1 rounded-full border border-gray-200/60 dark:border-gray-800/60 bg-white/50 dark:bg-black/50 backdrop-blur-sm text-xs font-medium tracking-wide text-gray-600 dark:text-gray-400 mb-8 shadow-sm">
                        Ruang Kerja Profesional
                    </div>
                    
                    <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-[6.5rem] font-bold tracking-tighter text-gray-900 dark:text-white leading-[1.05] mb-8">
                        Ketik rapi. <br>
                        <span class="font-serif italic font-normal text-gray-700 dark:text-gray-300">Atur sesukamu.</span>
                    </h1>
                    
                    <p class="mt-6 text-lg md:text-xl leading-relaxed text-gray-500 dark:text-gray-400 max-w-2xl mx-auto font-normal">
                        Kendalikan sepenuhnya dokumentasi Anda. Tulis, format, dan rapikan semua catatan ke dalam direktori pribadi tanpa kerumitan.
                    </p>
                    
                    <div class="mt-12 flex items-center justify-center gap-4">
                        <a href="{{ route('register') }}" class="rounded-full bg-gray-900 px-8 py-4 text-sm font-semibold text-white shadow-lg hover:shadow-xl hover:-translate-y-0.5 dark:bg-white dark:text-gray-900 transition-all duration-300">
                            Daftar Sekarang <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                        </a>
                    </div>
                </div>

                <div class="mt-24 lg:mt-32 max-w-4xl mx-auto animate-fade-in-up animate-float" style="animation-delay: 0.3s;">
                    <div class="rounded-3xl bg-white/60 dark:bg-[#0A0A0A]/60 backdrop-blur-xl border border-white/80 dark:border-gray-800/80 shadow-[0_20px_50px_rgba(0,0,0,0.05)] dark:shadow-[0_20px_50px_rgba(0,0,0,0.5)] overflow-hidden text-left ring-1 ring-gray-900/5 dark:ring-white/5">
                        
                        <div class="h-14 border-b border-gray-100 dark:border-gray-900/50 flex items-center px-6 bg-white/40 dark:bg-black/40">
                            <div class="flex gap-2.5">
                                <div class="w-3 h-3 rounded-full bg-gray-300 dark:bg-gray-700"></div>
                                <div class="w-3 h-3 rounded-full bg-gray-300 dark:bg-gray-700"></div>
                                <div class="w-3 h-3 rounded-full bg-gray-300 dark:bg-gray-700"></div>
                            </div>
                            <div class="mx-auto text-xs font-medium text-gray-400 dark:text-gray-600">Dokumen Tanpa Judul</div>
                            <div class="w-10"></div>
                        </div>
                        
                        <div class="p-10 md:p-14">
                            <h3 class="text-3xl md:text-4xl font-serif italic mb-8 text-gray-900 dark:text-white">Merancang Masa Depan</h3>
                            <div class="space-y-6 font-sans text-gray-600 dark:text-gray-400 text-lg font-normal leading-relaxed">
                                <p>Sistem pencatatan ini mendukung pemformatan tingkat lanjut untuk memperjelas alur pemikiran Anda:</p>
                                <ul class="space-y-3 pl-2">
                                    <li class="flex items-start gap-3">
                                        <span class="text-gray-300 dark:text-gray-700 mt-1"><i class="fa-solid fa-check"></i></span>
                                        <span>Penggunaan <strong class="text-gray-900 dark:text-white font-semibold">Teks Tebal (Bold)</strong> untuk menyoroti poin kritis.</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="text-gray-300 dark:text-gray-700 mt-1"><i class="fa-solid fa-check"></i></span>
                                        <span>Gaya <em class="font-serif text-gray-800 dark:text-gray-200">Teks Miring (Italic)</em> untuk kutipan atau istilah asing.</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="text-gray-300 dark:text-gray-700 mt-1"><i class="fa-solid fa-check"></i></span>
                                        <span>Serta <u class="underline-offset-4 text-gray-900 dark:text-white">Garis Bawah (Underline)</u> untuk klasifikasi data.</span>
                                    </li>
                                </ul>
                                <div class="pt-6 mt-8 border-t border-gray-100 dark:border-gray-900/50 flex items-center gap-3">
                                    <div class="w-2 h-6 bg-gray-900 dark:bg-white animate-pulse"></div>
                                    <span class="text-sm text-gray-400">Sedang mengetik...</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>

        <section id="features" class="py-32 bg-surface-light dark:bg-surface-dark border-y border-gray-100 dark:border-gray-900/50">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                
                <div class="mb-20 max-w-2xl reveal">
                    <h2 class="text-4xl md:text-5xl font-bold tracking-tight text-gray-900 dark:text-white leading-tight mb-6">
                        Dirancang untuk membantu Anda bekerja <br>
                        <span class="font-serif italic font-normal">dengan lebih cerdas.</span>
                    </h2>
                    <p class="text-lg text-gray-500 dark:text-gray-400 font-normal">
                        Aplikasi produktivitas kami dibangun untuk profesional modern yang ingin tetap terorganisir, fokus, dan memegang kendali penuh.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-x-12 gap-y-16">
                    
                    <div class="reveal" style="transition-delay: 0.1s;">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Penyunting Teks Lanjutan</h3>
                        <p class="text-gray-500 dark:text-gray-400 leading-relaxed font-normal">
                            Bikin catatanmu lebih jelas dengan struktur penulisan yang baik menggunakan fitur bold, italic, underline, hingga pembuatan daftar poin otomatis.
                        </p>
                    </div>

                    <div class="reveal" style="transition-delay: 0.2s;">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Manajemen Direktori</h3>
                        <p class="text-gray-500 dark:text-gray-400 leading-relaxed font-normal">
                            Kelompokkan setiap catatan ke dalam folder khusus agar pengerjaan tugas, catatan harian, maupun rencana proyek tetap teratur dan rapi.
                        </p>
                    </div>

                    <div class="reveal" style="transition-delay: 0.3s;">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Identifikasi Judul</h3>
                        <p class="text-gray-500 dark:text-gray-400 leading-relaxed font-normal">
                            Berikan identitas yang jelas pada setiap lembar tulisanmu menggunakan kolom judul yang terstruktur dan mudah ditemukan melalui sistem pencarian.
                        </p>
                    </div>

                </div>
            </div>
        </section>

        <section class="relative py-40 overflow-hidden">
            <div class="max-w-4xl mx-auto px-6 text-center reveal relative z-10">
                <h2 class="text-5xl md:text-6xl font-bold tracking-tight text-gray-900 dark:text-white mb-8">
                    Sederhanakan <br>
                    <span class="font-serif italic font-normal text-gray-600 dark:text-gray-400">cara Anda bekerja.</span>
                </h2>
                <div class="mt-12 flex justify-center">
                    <a href="{{ route('register') }}" class="rounded-full bg-gray-900 px-10 py-4 text-base font-semibold text-white shadow-xl hover:-translate-y-1 hover:shadow-2xl dark:bg-white dark:text-gray-900 transition-all duration-300">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </section>
    </main>

    <footer class="border-t border-gray-100 dark:border-gray-900/50 py-12 px-6 lg:px-12 bg-base-light dark:bg-base-dark">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-2">
                <span class="font-bold text-lg tracking-tight text-gray-900 dark:text-white">Knote</span>
            </div>
            <div class="flex gap-8 text-sm font-medium text-gray-400 dark:text-gray-500">
                <a href="#features" class="hover:text-gray-900 dark:hover:text-white transition-colors">Fitur</a>
            </div>
            <p class="text-sm text-gray-400 dark:text-gray-600 font-light">&copy; {{ date('Y') }} Knote.</p>
        </div>
    </footer>

    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');

        if (document.documentElement.classList.contains('dark')) {
            lightIcon.classList.remove('hidden');
        } else {
            darkIcon.classList.remove('hidden');
        }

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

        const revealElements = document.querySelectorAll('.reveal');
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        revealElements.forEach(el => revealObserver.observe(el));
    </script>
</body>
</html>