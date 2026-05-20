@extends('layouts.app')

@section('title', 'Folder Saya - Knote')

@section('content')
<div class="max-w-5xl mx-auto animate-fade-in">
    
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-8 animate-slide-up" style="animation-delay: 0.1s;">
        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Folder Catatan</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola folder untuk mengorganisasi seluruh catatan Anda secara terstruktur.</p>
        </div>
        
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full md:w-auto">
            <form action="{{ route('folders.index') }}" method="GET" class="relative w-full sm:w-64">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama folder..."
                    class="w-full pl-9 pr-12 py-2 text-sm rounded-lg border border-gray-200 dark:border-gray-800 bg-white dark:bg-[#18181B] focus:ring-2 focus:ring-blue-500 focus:outline-none dark:text-white placeholder-gray-400 shadow-sm">
                
                <span class="absolute left-3 top-2.5 text-gray-400 text-xs">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                
                @if(isset($search) && $search)
                    <a href="{{ route('folders.index') }}" class="absolute right-3 top-2.5 text-gray-400 hover:text-red-500 transition-colors cursor-pointer" title="Bersihkan Pencarian">
                        <i class="fa-regular fa-trash-can text-sm"></i>
                    </a>
                @endif
            </form>

            <button onclick="document.getElementById('addFolderModal').classList.remove('hidden')" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-blue-600 text-white hover:bg-blue-700 text-sm font-bold rounded-lg shadow-sm transition-all cursor-pointer whitespace-nowrap">
                <i class="fa-solid fa-plus"></i> Folder Baru
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-950/20 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-900/50 rounded-lg text-sm font-semibold flex items-center gap-2 animate-slide-up">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 animate-slide-up" style="animation-delay: 0.15s;">
        @forelse($folders as $index => $folder)
            @php
                // Membuat variasi warna berulang secara otomatis berdasarkan indeks iterasi
                $colors = [
                    ['bg' => 'bg-blue-50 dark:bg-blue-950/40', 'text' => 'text-blue-600 dark:text-blue-400'],
                    ['bg' => 'bg-amber-50 dark:bg-amber-950/40', 'text' => 'text-amber-600 dark:text-amber-400'],
                    ['bg' => 'bg-purple-50 dark:bg-purple-950/40', 'text' => 'text-purple-600 dark:text-purple-400'],
                    ['bg' => 'bg-emerald-50 dark:bg-emerald-950/40', 'text' => 'text-emerald-600 dark:text-emerald-400'],
                    ['bg' => 'bg-rose-50 dark:bg-rose-950/40', 'text' => 'text-rose-600 dark:text-rose-400']
                ];
                $colorPick = $colors[$index % count($colors)];
            @endphp

            <div class="relative bg-white dark:bg-[#18181B] p-5 rounded-xl border border-gray-200/85 dark:border-gray-800 shadow-sm hover:shadow-md hover:border-gray-300 dark:hover:border-gray-700 transition-all flex items-center justify-between group">
                
                <a href="{{ route('folders.show', $folder->id) }}" class="absolute inset-0 z-0 rounded-xl cursor-pointer"></a>

                <div class="flex items-center gap-4 relative z-10 pointer-events-none truncate mr-2">
                    <div class="w-12 h-12 flex items-center justify-center rounded-lg {{ $colorPick['bg'] }} {{ $colorPick['text'] }} transition-transform group-hover:scale-105 duration-200 flex-shrink-0">
                        <i class="fa-solid fa-folder text-xl"></i>
                    </div>
                    <div class="truncate">
                        <h3 class="font-bold text-sm text-gray-800 dark:text-gray-200 truncate group-hover:text-blue-500 transition-colors">
                            {{ $folder->name }}
                        </h3>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                            {{ $folder->notes_count }} Catatan
                        </p>
                    </div>
                </div>

                <div class="relative z-20 flex items-center gap-1">
                    <button onclick="openEditModal('{{ $folder->id }}', '{{ $folder->name }}')" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-950/30 dark:hover:text-blue-400 transition-all cursor-pointer" title="Ubah Nama Folder">
                        <i class="fa-regular fa-pen-to-square text-xs"></i>
                    </button>

                    <form action="{{ route('folders.destroy', $folder->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus folder ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-950/30 dark:hover:text-red-400 transition-all cursor-pointer" title="Hapus Folder">
                            <i class="fa-regular fa-trash-can text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center bg-white dark:bg-[#18181B] rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm">
                <span class="text-gray-300 dark:text-gray-700 text-3xl block mb-2"><i class="fa-solid fa-folder-open"></i></span>
                <p class="text-sm text-gray-400">
                    {{ (isset($search) && $search) ? 'Tidak ada nama folder yang sesuai dengan pencarian Anda.' : 'Belum ada folder yang dibuat pada akun ini.' }}
                </p>
            </div>
        @endforelse
    </div>
</div>

<div id="editFolderModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden backdrop-blur-sm animate-fade-in">
    <div class="bg-white dark:bg-[#18181B] border border-gray-200 dark:border-gray-800 w-full max-w-md p-6 rounded-xl shadow-xl mx-4">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Ubah Nama Folder</h3>
        <form id="editFolderForm" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-5">
                <input type="text" name="name" id="editFolderNameInput" required
                    class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-800 bg-transparent text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none dark:text-white font-medium">
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('editFolderModal').classList.add('hidden')" class="px-4 py-2 text-sm font-semibold text-gray-500 hover:text-gray-700 cursor-pointer">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-lg shadow-sm cursor-pointer">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, name) {
        const modal = document.getElementById('editFolderModal');
        const form = document.getElementById('editFolderForm');
        const input = document.getElementById('editFolderNameInput');
        
        form.action = `/folders/${id}`;
        input.value = name;
        
        modal.classList.remove('hidden');
    }
</script>
@endsection