<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knote - Notepad Sederhana</title>

    <!-- Google Fonts: Inter untuk UI, JetBrains Mono untuk teks notepad -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Asli -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    },
                    colors: {
                        // Warna dasar yang lebih hangat/natural (tidak kaku seperti AI)
                        paper: {
                            light: '#FCFCFA',
                            dark: '#0E0E11',
                        }
                    },
                    animation: {
                        'blink': 'blink 1s step-end infinite',
                        'slide-up': 'slideUp 0.6s cubic-bezier(0.22, 1, 0.36, 1) forwards',
                    },
                    keyframes: {
                        blink: {
                            '0%, 100%': { opacity: '1' },
                            '50%': { opacity: '0' },
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>

    <!-- Theme Initialization -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <style>
        /* Animasi scroll yang lebih natural, tidak kaku */
        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Garis tepi merah khas buku tulis */
        .margin-line {
            position: absolute;
            left: 3rem;
            top: 0;
            bottom: 0;
            width: 1px;
            background-color: rgba(239, 68, 68, 0.3);
            z-index: 0;
        }
        
        .dark .margin-line {
            background-color: rgba(239, 68, 68, 0.2);
        }

        /* Navigasi solid, BUKAN glassmorphism (anti-AI look) */
        .solid-nav {
            background-color: #FCFCFA;
            border-bottom: 1px solid #E5E7EB;
        }
        .dark .solid-nav {
            background-color: #0E0E11;
            border-bottom: 1px solid #27272A;
        }
    </style>
</head>
<body class="bg-paper-light text-gray-900 dark:bg-paper-dark dark:text-gray-100 antialiased transition-colors duration-200 selection:bg-gray-300 dark:selection:bg-gray-700">

    <!-- Navigation -->
    <header class="solid-nav fixed w-full top-0 z-50 transition-colors duration-200">
        <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
            
            <!-- Logo menggunakan Asset Laravel -->
            <a href="#" class="flex items-center gap-2 group">
                <img src="{{ asset('images/logo.png') }}" alt="Knote Logo" class="h-6 w-auto dark:invert transition-all duration-200 group-hover:scale-95">
                <span class="text-lg font-bold tracking-tight">Knote</span>
            </a>
            
            <nav class="hidden md:flex gap-8 text-sm font-medium text-gray-500 dark:text-gray-400">
                <a href="#features" class="hover:text-gray-900 dark:hover:text-white transition-colors">Fitur</a>
                <a href="#about" class="hover:text-gray-900 dark:hover:text-white transition-colors">Tentang</a>
            </nav>

            <div class="flex items-center gap-4">
                <button id="theme-toggle" class="w-8 h-8 flex items-center justify-center rounded-md text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 transition-colors" title="Ubah Tema">
                    <i id="theme-toggle-dark-icon" class="fa-solid fa-moon hidden text-sm"></i>
                    <i id="theme-toggle-light-icon" class="fa-solid fa-sun hidden text-sm"></i>
                </button>
                <a href="#" class="hidden sm:block text-sm font-medium hover:text-gray-600 transition-colors">Masuk</a>
                <a href="#" class="bg-gray-900 text-white dark:bg-white dark:text-gray-900 hover:bg-gray-800 dark:hover:bg-gray-200 px-5 py-2.5 rounded-md text-sm font-semibold transition-colors shadow-sm">
                    Buka Knote
                </a>
            </div>
        </div>
    </header>

    <main class="pt-16">
        
        <!-- Hero Section -->
        <section class="relative min-h-[90vh] flex items-center pt-10 pb-20 overflow-hidden">
            <div class="max-w-6xl mx-auto px-6 w-full grid lg:grid-cols-2 gap-16 items-center">
                
                <!-- Left: Typography & CTA -->
                <div class="space-y-8 animate-slide-up z-10 relative">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-md border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 shadow-sm">
                        <i class="fa-solid fa-pen text-gray-800 dark:text-gray-200"></i>
                        Notepad Klasik. Tanpa Distraksi.
                    </div>
                    
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight leading-[1.1]">
                        Ketik sekarang.<br>
                        <span class="text-gray-400 dark:text-gray-500">Pikirkan nanti.</span>
                    </h1>
                    
                    <p class="text-lg text-gray-600 dark:text-gray-400 max-w-lg leading-relaxed">
                        Tidak ada folder rumit, tidak ada formatting tebal-miring, tidak ada sinkronisasi cloud yang lelet. Murni hanya layar kosong untuk menampung pikiranmu dengan cepat.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="#" class="inline-flex justify-center items-center gap-2 bg-gray-900 text-white dark:bg-white dark:text-gray-900 hover:bg-gray-800 dark:hover:bg-gray-200 px-8 py-4 rounded-md font-bold text-base transition-colors shadow-sm">
                            <i class="fa-solid fa-keyboard"></i> Mulai Mengetik
                        </a>
                        <a href="#features" class="inline-flex justify-center items-center gap-2 bg-white text-gray-900 border border-gray-200 dark:bg-gray-900 dark:text-white dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800 px-8 py-4 rounded-md font-bold text-base transition-colors">
                            Lihat Fitur
                        </a>
                    </div>
                </div>

                <!-- Right: Custom CSS Notepad Art (Non-AI Vibe) -->
                <div class="relative w-full max-w-md mx-auto lg:ml-auto animate-slide-up" style="animation-delay: 0.2s;">
                    <!-- The Paper -->
                    <div class="relative aspect-[3/4] bg-[#FFFFFE] dark:bg-[#18181B] rounded-lg shadow-2xl border border-gray-200 dark:border-gray-800 overflow-hidden transform rotate-2 hover:rotate-0 transition-transform duration-300 origin-bottom-right">
                        
                        <!-- Notebook Margin -->
                        <div class="margin-line"></div>
                        
                        <!-- Notebook Binder Holes -->
                        <div class="absolute left-4 top-10 w-3 h-3 rounded-full bg-paper-light dark:bg-paper-dark border border-gray-200 dark:border-gray-800 shadow-inner"></div>
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 w-3 h-3 rounded-full bg-paper-light dark:bg-paper-dark border border-gray-200 dark:border-gray-800 shadow-inner"></div>
                        <div class="absolute left-4 bottom-10 w-3 h-3 rounded-full bg-paper-light dark:bg-paper-dark border border-gray-200 dark:border-gray-800 shadow-inner"></div>

                        <!-- Ruled Lines & Text -->
                        <div class="absolute inset-0 pt-16 flex flex-col pointer-events-none">
                            <!-- CSS Lines -->
                            <div class="h-8 border-b border-blue-200/50 dark:border-blue-900/30 w-full relative">
                                <span class="absolute left-16 bottom-1 font-mono text-sm text-gray-800 dark:text-gray-200">Hari ini: Belanja & Coding</span>
                            </div>
                            <div class="h-8 border-b border-blue-200/50 dark:border-blue-900/30 w-full relative">
                                <span class="absolute left-16 bottom-1 font-mono text-sm text-gray-800 dark:text-gray-200">- Beli kopi bubuk</span>
                            </div>
                            <div class="h-8 border-b border-blue-200/50 dark:border-blue-900/30 w-full relative">
                                <span class="absolute left-16 bottom-1 font-mono text-sm text-gray-800 dark:text-gray-200">- Perbaiki UI halaman depan</span>
                            </div>
                            <div class="h-8 border-b border-blue-200/50 dark:border-blue-900/30 w-full relative">
                                <span class="absolute left-16 bottom-1 font-mono text-sm text-gray-800 dark:text-gray-200">- Fix bug dark mode</span>
                            </div>
                            <div class="h-8 border-b border-blue-200/50 dark:border-blue-900/30 w-full relative">
                                <!-- Blinking cursor -->
                                <span class="absolute left-16 bottom-1 font-mono text-sm text-gray-800 dark:text-gray-200">- <span class="inline-block w-2 h-4 bg-gray-900 dark:bg-gray-100 animate-blink translate-y-0.5"></span></span>
                            </div>
                            <!-- Empty lines to fill paper -->
                            <div class="h-8 border-b border-blue-200/50 dark:border-blue-900/30 w-full"></div>
                            <div class="h-8 border-b border-blue-200/50 dark:border-blue-900/30 w-full"></div>
                            <div class="h-8 border-b border-blue-200/50 dark:border-blue-900/30 w-full"></div>
                            <div class="h-8 border-b border-blue-200/50 dark:border-blue-900/30 w-full"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section (Classic Layout, No Bento Box) -->
        <section id="features" class="py-24 border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-[#121214]">
            <div class="max-w-6xl mx-auto px-6">
                
                <div class="max-w-2xl mb-16 reveal">
                    <h2 class="text-3xl md:text-4xl font-bold tracking-tight mb-4">Kembali ke dasar.</h2>
                    <p class="text-gray-600 dark:text-gray-400 text-lg">Aplikasi catatan zaman sekarang terlalu rumit. Knote hadir untuk satu tujuan: menjadi tempatmu mengetik.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    
                    <!-- Feature 1 -->
                    <div class="reveal" style="transition-delay: 0.1s;">
                        <div class="w-14 h-14 rounded-lg border-2 border-gray-900 dark:border-gray-100 flex items-center justify-center mb-6 bg-paper-light dark:bg-gray-900 shadow-[4px_4px_0px_0px_rgba(17,24,39,1)] dark:shadow-[4px_4px_0px_0px_rgba(243,244,246,1)]">
                            <i class="fa-solid fa-bolt text-2xl text-gray-900 dark:text-gray-100"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Sangat Ringan</h3>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            Tidak ada fitur berat yang membebani browser. Knote dimuat dalam hitungan milidetik. Buka dan langsung ketik.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="reveal" style="transition-delay: 0.2s;">
                        <div class="w-14 h-14 rounded-lg border-2 border-gray-900 dark:border-gray-100 flex items-center justify-center mb-6 bg-paper-light dark:bg-gray-900 shadow-[4px_4px_0px_0px_rgba(17,24,39,1)] dark:shadow-[4px_4px_0px_0px_rgba(243,244,246,1)]">
                            <i class="fa-solid fa-align-left text-2xl text-gray-900 dark:text-gray-100"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Teks Biasa (Plain Text)</h3>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            Murni teks. Tidak ada tombol untuk mempertebal huruf (bold) atau mengatur warna. Persis seperti Notepad di komputermu.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="reveal" style="transition-delay: 0.3s;">
                        <div class="w-14 h-14 rounded-lg border-2 border-gray-900 dark:border-gray-100 flex items-center justify-center mb-6 bg-paper-light dark:bg-gray-900 shadow-[4px_4px_0px_0px_rgba(17,24,39,1)] dark:shadow-[4px_4px_0px_0px_rgba(243,244,246,1)]">
                            <i class="fa-solid fa-eye-slash text-2xl text-gray-900 dark:text-gray-100"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Fokus Penuh</h3>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            Antarmuka super bersih. Hilangkan semua tombol dan menu yang tidak perlu agar kamu bisa fokus 100% pada tulisanmu.
                        </p>
                    </div>

                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="py-24 border-t border-gray-200 dark:border-gray-800">
            <div class="max-w-3xl mx-auto px-6 text-center reveal">
                <h2 class="text-3xl md:text-4xl font-bold tracking-tight mb-8">Tidak butuh waktu lama untuk memulai.</h2>
                <a href="#" class="inline-flex items-center justify-center gap-3 bg-gray-900 text-white dark:bg-white dark:text-gray-900 hover:bg-gray-800 dark:hover:bg-gray-200 px-8 py-4 rounded-md font-bold text-lg transition-colors shadow-[6px_6px_0px_0px_rgba(156,163,175,0.5)] dark:shadow-[6px_6px_0px_0px_rgba(75,85,99,0.5)] active:translate-y-1 active:translate-x-1 active:shadow-none">
                    <i class="fa-solid fa-pen-nib"></i> Buka Notepad Sekarang
                </a>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-200 dark:border-gray-800 py-10 px-6 bg-white dark:bg-[#121214] transition-colors duration-200">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
            
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="Knote" class="w-5 h-5 dark:invert opacity-80">
                <span class="font-bold text-gray-900 dark:text-white tracking-tight">Knote</span>
            </div>
            
            <div class="flex gap-6 text-sm text-gray-500 dark:text-gray-400 font-medium">
                <a href="#" class="hover:text-gray-900 dark:hover:text-white transition-colors">Kontak</a>
                <a href="#" class="hover:text-gray-900 dark:hover:text-white transition-colors">Privasi</a>
            </div>
            
            <p class="text-sm text-gray-400 dark:text-gray-500 font-mono">Dibuat sesederhana mungkin.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Dark/Light Mode Logic
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

        // Clean Reveal Animation on Scroll
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