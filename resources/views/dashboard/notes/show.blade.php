@extends('layouts.app')

@section('title', $note->title . ' - Knote')

@section('content')
<div class="max-w-3xl mx-auto animate-fade-in pb-12">
    
    <div class="mb-6 animate-slide-up" style="animation-delay: 0.1s;">
        <a href="{{ route('notes.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-gray-400 hover:text-gray-600 uppercase tracking-wider transition-colors cursor-pointer">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Catatan
        </a>
    </div>

    <div class="bg-white dark:bg-[#18181B] p-6 md:p-8 rounded-xl border border-gray-200/85 dark:border-gray-855 shadow-sm animate-slide-up" style="animation-delay: 0.15s;">
        
        <div class="flex flex-wrap items-center justify-between gap-2 mb-6 pb-4 border-b border-gray-100 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <span class="text-xs font-mono text-gray-400">
                    <i class="fa-regular fa-calendar mr-1"></i> {{ $note->created_at->format('d M Y, H:i') }}
                </span>
                @if($note->folder)
                    <span class="text-[10px] font-bold px-2 py-0.5 bg-amber-50 dark:bg-amber-950/40 text-amber-600 dark:text-amber-400 rounded-md">
                        📁 {{ $note->folder->name }}
                    </span>
                @endif
            </div>
        </div>

        <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight mb-6">
            {{ $note->title }}
        </h1>

        <div class="text-sm md:text-base text-gray-700 dark:text-gray-300 leading-relaxed space-y-4 font-sans whitespace-pre-line">
            {!! $note->content !!}
        </div>
    </div>
</div>
@endsection