@extends('layouts.app')

@section('title', 'Beranda - Knote')

@section('content')
<div class="max-w-7xl mx-auto animate-fade-in space-y-12">
    
    <div class="relative bg-white dark:bg-[#18181B] rounded-2xl p-8 border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden animate-slide-up" style="animation-delay: 0.1s;">
        <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-50 to-transparent dark:from-blue-900/10 dark:to-transparent rounded-full blur-3xl -mr-20 -mt-20 pointer-events-none"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-8">
            <div class="max-w-xl">
                <span class="inline-block py-1 px-3 rounded-full bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-[10px] font-bold tracking-widest uppercase mb-3">
                    Beranda Utama
                </span>
                <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-2">
                    Selamat Datang, {{ auth()->user()->name }}
                </h1>
                <p class="text-sm md:text-base text-gray-500 dark:text-gray-400 leading-relaxed">
                    Kelola seluruh ide, tugas, dan dokumentasi Anda dalam satu ruang kerja yang terstruktur dan aman.
                </p>
            </div>
            
            <div class="flex flex-wrap gap-4">
                <div class="bg-gray-50 dark:bg-gray-800/50 px-6 py-4 rounded-xl border border-gray-100 dark:border-gray-800 min-w-[120px] text-center">
                    <span class="block text-[10px] text-gray-400 uppercase font-bold tracking-wider mb-1">Total Catatan</span>
                    <span class="text-2xl font-extrabold text-gray-900 dark:text-white">
                        {{ isset($notes) ? $notes->count() : 0 }}
                    </span>
                </div>
                <div class="bg-gray-50 dark:bg-gray-800/50 px-6 py-4 rounded-xl border border-gray-100 dark:border-gray-800 min-w-[120px] text-center">
                    <span class="block text-[10px] text-gray-400 uppercase font-bold tracking-wider mb-1">Total Folder</span>
                    <span class="text-2xl font-extrabold text-gray-900 dark:text-white">
                        {{ $foldersCount ?? 0 }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="animate-slide-up" style="animation-delay: 0.15s;">
        <h2 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-5 flex items-center gap-2">
            <i class="fa-solid fa-bolt text-gray-300 dark:text-gray-600"></i> Akses Cepat
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            
            <a href="{{ route('notes.create') }}" class="group relative overflow-hidden p-6 bg-white dark:bg-[#18181B] rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 dark:bg-blue-900/10 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                    <h3 class="font-bold text-base text-gray-900 dark:text-white mb-1">Catatan Baru</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Tulis dan simpan ide baru Anda secara instan.</p>
                </div>
            </a>

            <a href="{{ route('folders.index') }}" class="group relative overflow-hidden p-6 bg-white dark:bg-[#18181B] rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                <div class="absolute top-0 right-0 w-24 h-24 bg-amber-50 dark:bg-amber-900/10 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-folder-open"></i>
                    </div>
                    <h3 class="font-bold text-base text-gray-900 dark:text-white mb-1">Kelola Folder</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Atur dan rapikan direktori penyimpanan Anda.</p>
                </div>
            </a>

            <a href="{{ route('account.index') }}" class="group relative overflow-hidden p-6 bg-white dark:bg-[#18181B] rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                <div class="absolute top-0 right-0 w-24 h-24 bg-purple-50 dark:bg-purple-900/10 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-user-gear"></i>
                    </div>
                    <h3 class="font-bold text-base text-gray-900 dark:text-white mb-1">Pengaturan Akun</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Konfigurasi profil dan keamanan kata sandi.</p>
                </div>
            </a>

        </div>
    </div>

    <div class="animate-slide-up" style="animation-delay: 0.2s;">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-xs font-bold uppercase tracking-widest text-gray-400 flex items-center gap-2">
                <i class="fa-solid fa-clock-rotate-left text-gray-300 dark:text-gray-600"></i> Catatan Terakhir
            </h2>
            <a href="{{ route('notes.index') }}" class="text-xs font-bold text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
                Lihat Semua <i class="fa-solid fa-arrow-right ml-1"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse($notes->take(6) ?? [] as $index => $note)
                @php
                    $colors = [
                        ['bg' => 'bg-blue-50 dark:bg-blue-950/40', 'text' => 'text-blue-600 dark:text-blue-400'],
                        ['bg' => 'bg-amber-50 dark:bg-amber-950/40', 'text' => 'text-amber-600 dark:text-amber-400'],
                        ['bg' => 'bg-purple-50 dark:bg-purple-950/40', 'text' => 'text-purple-600 dark:text-purple-400'],
                        ['bg' => 'bg-emerald-50 dark:bg-emerald-950/40', 'text' => 'text-emerald-600 dark:text-emerald-400'],
                        ['bg' => 'bg-rose-50 dark:bg-rose-950/40', 'text' => 'text-rose-600 dark:text-rose-400']
                    ];
                    $colorPick = $colors[$index % count($colors)];
                @endphp

                <div class="relative bg-white dark:bg-[#18181B] p-6 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between min-h-[190px] group animate-slide-up" style="animation-delay: {{ 0.25 + ($index * 0.05) }}s;">
                    
                    <a href="{{ route('notes.show', $note->id) }}" class="absolute inset-0 z-0 rounded-2xl cursor-pointer"></a>

                    <div class="relative z-10 pointer-events-none">
                        <div class="flex items-center justify-between gap-2 mb-3">
                            <span class="text-[10px] font-mono font-medium text-gray-400">{{ $note->created_at->translatedFormat('d M Y') ?? $note->created_at->format('d M Y') }}</span>
                            @if($note->folder)
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-md truncate max-w-[120px] {{ $colorPick['bg'] }} {{ $colorPick['text'] }}">
                                    <i class="fa-solid fa-folder mr-1"></i> {{ $note->folder->name }}
                                </span>
                            @else
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-md truncate max-w-[120px] bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400">
                                    Tanpa Folder
                                </span>
                            @endif
                        </div>

                        <h3 class="font-bold text-base text-gray-900 dark:text-white line-clamp-1 mb-2 group-hover:text-blue-500 transition-colors">
                            {{ $note->title }}
                        </h3>

                        <div class="text-xs text-gray-500 dark:text-gray-400 line-clamp-3 leading-relaxed">
                            {!! strip_tags($note->content) !!}
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-4 mt-4 border-t border-gray-50 dark:border-gray-800/50 relative z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <a href="{{ route('notes.edit', $note->id) }}" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/30 dark:hover:text-blue-400 transition-all cursor-pointer" title="Ubah Catatan">
                            <i class="fa-regular fa-pen-to-square text-xs"></i>
                        </a>

                        <form action="{{ route('notes.destroy', $note->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus catatan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/30 dark:hover:text-red-400 transition-all cursor-pointer" title="Hapus Catatan">
                                <i class="fa-regular fa-trash-can text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 px-4 bg-white dark:bg-[#18181B] rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-800 flex flex-col items-center justify-center text-center shadow-sm">
                    <div class="w-16 h-16 rounded-full bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 dark:text-blue-400 mb-4 animate-bounce">
                        <i class="fa-solid fa-file-pen text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Belum Terdapat Catatan</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 max-w-sm mt-2 leading-relaxed">
                        Anda belum memiliki catatan yang tersimpan. Silakan mulai dokumentasi pertama Anda untuk menyimpannya di dalam sistem.
                    </p>
                    <a href="{{ route('notes.create') }}" class="mt-6 px-6 py-2.5 bg-blue-600 text-white hover:bg-blue-700 rounded-lg text-sm font-bold shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-0.5 cursor-pointer flex items-center gap-2">
                        <i class="fa-solid fa-plus"></i> Buat Catatan Pertama
                    </a>
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection