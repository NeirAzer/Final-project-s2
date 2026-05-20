<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Knote')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
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
                        mono: ['JetBrains Mono', 'monospace'],
                    },
                    colors: {
                        paper: {
                            light: '#F8FAFC',
                            dark: '#09090B',
                        }
                    },
                    animation: {
                        'slide-up': 'slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                        'fade-in': 'fadeIn 0.5s ease-out forwards',
                    },
                    keyframes: {
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(16px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
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
        /* Kustomisasi Scrollbar Premium */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background-color: #CBD5E1;
            border-radius: 10px;
        }
        .dark ::-webkit-scrollbar-thumb {
            background-color: #27272A;
        }
        ::-webkit-scrollbar-thumb:hover {
            background-color: #94A3B8;
        }
        .dark ::-webkit-scrollbar-thumb:hover {
            background-color: #3F3F46;
        }

        /* Material Sidebar & Header */
        .glass-header {
            background: rgba(248, 250, 252, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }
        .dark .glass-header {
            background: rgba(9, 9, 11, 0.8);
            border-bottom: 1px solid rgba(39, 39, 42, 0.8);
        }

        .solid-sidebar {
            background-color: #FFFFFF;
            border-right: 1px solid #F1F5F9;
        }
        .dark .solid-sidebar {
            background-color: #0E0E11;
            border-right: 1px solid #18181B;
        }
    </style>
</head>
<body class="bg-paper-light text-gray-900 dark:bg-paper-dark dark:text-gray-100 antialiased transition-colors duration-300 selection:bg-blue-200 dark:selection:bg-blue-900/50 font-sans">

    <div class="flex h-screen flex-col md:flex-row overflow-hidden">
        
        <aside id="sidebar" class="solid-sidebar fixed inset-y-0 left-0 z-50 w-72 transform -translate-x-full md:translate-x-0 md:relative md:flex flex-col transition-transform duration-300 ease-in-out shadow-2xl md:shadow-none">
            
            <div class="h-16 px-6 flex justify-between items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo.png') }}" alt="Knote Logo" class="h-7 w-auto transition-transform duration-300 group-hover:scale-95 drop-shadow-sm">
                    <span class="text-xl font-extrabold tracking-tight text-gray-900 dark:text-white">Knote</span>
                </a>
                <button onclick="toggleSidebar()" class="md:hidden w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 dark:text-gray-400 transition-colors cursor-pointer">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            
            <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-1.5">
                <p class="px-3 text-[10px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-3">Menu Utama</p>
                
                <a href="{{ route('dashboard') }}" 
                class="group flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 cursor-pointer 
                {{ request()->routeIs('dashboard') 
                    ? 'bg-gray-900 text-white dark:bg-white dark:text-gray-900 shadow-md shadow-gray-900/10 dark:shadow-white/10' 
                    : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800/50 hover:text-gray-900 dark:hover:text-white' }}">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg {{ request()->routeIs('dashboard') ? 'bg-white/20 dark:bg-black/10' : 'bg-gray-100 dark:bg-gray-800 group-hover:bg-white dark:group-hover:bg-gray-700' }} transition-colors">
                        <i class="fa-solid fa-house"></i>
                    </div>
                    Beranda
                </a>

                <a href="{{ route('notes.index') }}" 
                class="group flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 cursor-pointer 
                {{ request()->routeIs('notes.index') || request()->routeIs('notes.create')
                    ? 'bg-blue-600 text-white dark:bg-blue-500 shadow-md shadow-blue-600/20' 
                    : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800/50 hover:text-gray-900 dark:hover:text-white' }}">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg {{ request()->routeIs('notes.index') || request()->routeIs('notes.create') ? 'bg-white/20' : 'bg-gray-100 dark:bg-gray-800 group-hover:bg-white dark:group-hover:bg-gray-700' }} transition-colors">
                        <i class="fa-regular fa-file-lines"></i>
                    </div>
                    Catatan
                </a>
                
                <a href="{{ route('folders.index') }}" 
                class="group flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 cursor-pointer 
                {{ request()->routeIs('folders.index') || request()->routeIs('folders.show')
                    ? 'bg-amber-500 text-white shadow-md shadow-amber-500/20' 
                    : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800/50 hover:text-gray-900 dark:hover:text-white' }}">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg {{ request()->routeIs('folders.index') || request()->routeIs('folders.show') ? 'bg-white/20' : 'bg-gray-100 dark:bg-gray-800 group-hover:bg-white dark:group-hover:bg-gray-700' }} transition-colors">
                        <i class="fa-solid fa-folder-open"></i>
                    </div>
                    Folder
                </a>
                
                <div class="pt-6 pb-2">
                    <p class="px-3 text-[10px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-3">Pengaturan</p>
                </div>

                <a href="{{ route('account.index') }}" 
                class="group flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 cursor-pointer 
                {{ request()->routeIs('account.index') 
                    ? 'bg-purple-600 text-white shadow-md shadow-purple-600/20' 
                    : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800/50 hover:text-gray-900 dark:hover:text-white' }}">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg {{ request()->routeIs('account.index') ? 'bg-white/20' : 'bg-gray-100 dark:bg-gray-800 group-hover:bg-white dark:group-hover:bg-gray-700' }} transition-colors">
                        <i class="fa-solid fa-user-gear"></i>
                    </div>
                    Konfigurasi Akun
                </a>
            </nav>

            <div class="p-4 m-4 rounded-2xl bg-gray-50 dark:bg-[#121215] border border-gray-100 dark:border-gray-800/60">
                <div class="flex items-center gap-3 mb-4">
                    <div class="relative flex-shrink-0">
                        @if(auth()->user()->profile_photo && file_exists(public_path('uploads/profile/' . auth()->user()->profile_photo)))
                            <img src="{{ asset('uploads/profile/' . auth()->user()->profile_photo) }}" alt="Avatar" class="w-10 h-10 rounded-full object-cover border-2 border-white dark:border-gray-700 shadow-sm">
                        @else
                            <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold text-sm uppercase border-2 border-white dark:border-gray-700 shadow-sm">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                        @endif
                        <span class="absolute bottom-0 right-0 w-3 h-3 bg-emerald-500 border-2 border-white dark:border-[#121215] rounded-full"></span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 py-2 px-3 rounded-lg text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 dark:bg-red-950/30 dark:text-red-400 dark:hover:bg-red-900/40 transition-colors cursor-pointer border border-red-100 dark:border-transparent">
                        <i class="fa-solid fa-power-off"></i> Akhiri Sesi
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex flex-col flex-1 min-w-0 overflow-hidden relative">
            
            <header class="glass-header sticky top-0 z-30 h-16 px-4 md:px-8 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()" class="md:hidden w-10 h-10 flex items-center justify-center rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors cursor-pointer">
                        <i class="fa-solid fa-bars-staggered text-lg"></i>
                    </button>
                </div>

                <div class="flex items-center gap-3">
                    <button id="theme-toggle" onclick="toggleDarkMode()" class="w-10 h-10 flex items-center justify-center rounded-full bg-white dark:bg-[#18181B] border border-gray-200 dark:border-gray-800 text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400 shadow-sm transition-all duration-300 cursor-pointer hover:shadow-md" title="Ubah Tema Visual">
                        <i id="theme-toggle-dark-icon" class="fa-solid fa-moon hidden text-base"></i>
                        <i id="theme-toggle-light-icon" class="fa-solid fa-sun hidden text-base"></i>
                    </button>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-4 md:p-8 transition-colors duration-300">
                @yield('content')
            </main>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const darkIcon = document.getElementById('theme-toggle-dark-icon');
            const lightIcon = document.getElementById('theme-toggle-light-icon');

            if (document.documentElement.classList.contains('dark')) {
                lightIcon.classList.remove('hidden');
                darkIcon.classList.add('hidden');
            } else {
                darkIcon.classList.remove('hidden');
                lightIcon.classList.add('hidden');
            }
        });

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }

        function toggleDarkMode() {
            const html = document.documentElement;
            const darkIcon = document.getElementById('theme-toggle-dark-icon');
            const lightIcon = document.getElementById('theme-toggle-light-icon');

            darkIcon.classList.toggle('hidden');
            lightIcon.classList.toggle('hidden');

            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        }
    </script>
</body>
</html> 