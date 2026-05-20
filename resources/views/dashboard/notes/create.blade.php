@extends('layouts.app')

@section('title', 'Catatan Baru - Knote')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />

<div class="max-w-3xl mx-auto animate-fade-in">
    <div class="mb-6 animate-slide-up" style="animation-delay: 0.1s;">
        <h1 class="text-2xl font-extrabold tracking-tight">Buat Catatan Baru</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Tulis ide, tugas, atau memo pentingmu di sini.</p>
    </div>

    <div class="bg-white dark:bg-[#18181B] p-6 rounded-xl border border-gray-200/85 dark:border-gray-850 shadow-sm animate-slide-up" style="animation-delay: 0.15s;">
        <form action="{{ route('notes.store') }}" method="POST" id="noteForm" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Judul Catatan</label>
                <input type="text" name="title" placeholder="Masukkan judul catatan..." value="{{ old('title') }}" required
                    class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-800 bg-transparent focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all dark:text-white placeholder-gray-400 dark:placeholder-gray-600">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Masukkan ke Folder (Opsional)</label>
                <select name="folder_id" 
                    class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-800 bg-transparent focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all dark:text-white cursor-pointer dark:bg-[#18181B]">
                    <option value="" class="dark:bg-[#18181B]">📁 Tanpa Folder (Catatan Umum)</option>
                    @foreach($folders as $folder)
                        <option value="{{ $folder->id }}" class="dark:bg-[#18181B]">📁 {{ $folder->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Isi Catatan</label>
                
                <input type="hidden" name="content" id="contentInput">

                <div class="rounded-lg border border-gray-200 dark:border-gray-800 overflow-hidden bg-transparent">
                    <div id="editor" class="min-h-[250px] text-base dark:text-white font-sans border-none">
                        {!! old('content') !!}
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('dashboard') }}" 
                    class="px-5 py-2.5 border border-gray-200 dark:border-gray-800 rounded-lg text-sm font-semibold text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                    class="px-5 py-2.5 bg-gray-900 text-white dark:bg-white dark:text-gray-900 hover:bg-gray-800 dark:hover:bg-gray-200 font-semibold rounded-lg text-sm shadow-sm transition-all hover:scale-[1.01] active:scale-[0.99] cursor-pointer">
                    <i class="fa-solid fa-floppy-disk mr-1.5"></i> Simpan Catatan
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .ql-toolbar.ql-snow {
        border-color: rgba(229, 231, 235, 0.85) !important;
        background-color: rgba(249, 250, 251, 0.5);
    }
    .dark .ql-toolbar.ql-snow {
        border-color: #27272A !important;
        background-color: #121214;
    }
    .dark .ql-toolbar .ql-stroke {
        stroke: #A1A1AA !important;
    }
    .dark .ql-toolbar .ql-fill {
        fill: #A1A1AA !important;
    }
    .dark .ql-toolbar .ql-picker {
        color: #A1A1AA !important;
    }
    .ql-container.ql-snow {
        border: none !important;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script>
    // Inisialisasi Quill Editor dengan tombol Toolbar sesuai request (Bold, Italic, Underline, List)
    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline'], // Tombol format teks sesuai request
                [{ 'list': 'ordered'}, { 'list': 'bullet' }], // Tombol list urutan/poin sesuai request
                ['clean'] // Tombol hapus format
            ]
        }
    });

    // Logika menyalin konten teks editor ke input hidden sebelum form dikirim ke backend Laravel
    const form = document.getElementById('noteForm');
    form.onsubmit = function() {
        const contentInput = document.getElementById('contentInput');
        
        // Cek jika editor kosong (hanya berisi tag paragraf kosong bawaan Quill)
        if (quill.getText().trim().length === 0) {
            contentInput.value = '';
        } else {
            // Mengambil data lengkap berformat HTML dari editor
            contentInput.value = quill.root.innerHTML;
        }
    };
</script>
@endsection