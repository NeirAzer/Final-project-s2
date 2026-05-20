@extends('layouts.app')

@section('title', 'Folder ' . $folder->name . ' - Knote')

@section('content')
<div class="max-w-5xl mx-auto animate-fade-in">
    
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-8 animate-slide-up" style="animation-delay: 0.1s;">
        <div>
            <div class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">
                <a href="{{ route('folders.index') }}" class="hover:text-gray-700 transition-colors cursor-pointer">Folder</a>
                <span>/</span>
                <span class="text-gray-600 dark:text-gray-300">{{ $folder->name }}</span>
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight flex items-center gap-3 text-gray-900 dark:text-white">
                <span class="text-blue-600 dark:text-blue-400"><i class="fa-solid fa-folder-open"></i></span> {{ $folder->name }}
            </h1>
        </div>

        <form action="{{ route('folders.show', $folder->id) }}" method="GET" class="w-full md:max-w-xs relative">
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari catatan di folder ini..."
                class="w-full pl-9 pr-12 py-2 text-sm rounded-lg border border-gray-200 dark:border-gray-800 bg-white dark:bg-[#18181B] focus:ring-2 focus:ring-blue-500 focus:outline-none dark:text-white placeholder-gray-400 shadow-sm">
            
            <span class="absolute left-3 top-2.5 text-gray-400 text-xs">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            
            @if($search)
                <a href="{{ route('folders.show', $folder->id) }}" class="absolute right-3 top-2.5 text-gray-400 hover:text-red-500 transition-colors cursor-pointer" title="Bersihkan Pencarian">
                    <i class="fa-regular fa-trash-can text-sm"></i>
                </a>
            @endif
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 animate-slide-up" style="animation-delay: 0.15s;">
        @forelse($notes as $note)
            <div class="relative bg-white dark:bg-[#18181B] p-5 rounded-xl border border-gray-200/85 dark:border-gray-800 shadow-sm hover:shadow-md hover:border-gray-300 dark:hover:border-gray-700 transition-all flex flex-col justify-between min-h-[180px] group">
                
                <a href="{{ route('notes.show', $note->id) }}" class="absolute inset-0 z-0 rounded-xl cursor-pointer"></a>

                <div class="relative z-10 pointer-events-none">
                    <span class="text-[10px] font-mono text-gray-400 block mb-2">{{ $note->created_at->format('d M Y') }}</span>
                    <h3 class="font-bold text-base text-gray-800 dark:text-gray-200 line-clamp-1 mb-1 group-hover:text-blue-500 transition-colors">
                        {{ $note->title }}
                    </h3>
                    <div class="text-xs text-gray-500 dark:text-gray-400 line-clamp-3 leading-relaxed mb-4">
                        {!! strip_tags($note->content) !!}
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-gray-100 dark:border-gray-800 relative z-20">
                    <a href="{{ route('notes.edit', $note->id) }}" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-950/30 dark:hover:text-blue-400 transition-all cursor-pointer" title="Ubah Catatan">
                        <i class="fa-regular fa-pen-to-square text-xs"></i>
                    </a>

                    <form action="{{ route('notes.destroy', $note->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus catatan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-950/30 dark:hover:text-red-400 transition-all cursor-pointer" title="Hapus Catatan">
                            <i class="fa-regular fa-trash-can text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center bg-white dark:bg-[#18181B] rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm">
                <span class="text-gray-300 dark:text-gray-700 text-3xl block mb-2"><i class="fa-solid fa-note-sticky"></i></span>
                <p class="text-sm text-gray-400">
                    {{ $search ? 'Tidak ada judul catatan yang sesuai dengan pencarian Anda.' : 'Belum ada catatan di dalam folder ini.' }}
                </p>
            </div>
        @endforelse
    </div>
</div>
@endsection