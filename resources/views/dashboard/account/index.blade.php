@extends('layouts.app')

@section('title', 'Akun Saya - Knote')

@section('content')
<div class="max-w-6xl mx-auto animate-fade-in pb-12 space-y-8">
    
    <div class="relative bg-white dark:bg-[#18181B] rounded-2xl p-8 border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden animate-slide-up" style="animation-delay: 0.1s;">
        <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-purple-50 to-transparent dark:from-purple-900/10 dark:to-transparent rounded-full blur-3xl -mr-20 -mt-20 pointer-events-none"></div>
        <div class="relative z-10">
            <span class="inline-block py-1 px-3 rounded-full bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 text-[10px] font-bold tracking-widest uppercase mb-3">
                Konfigurasi
            </span>
            <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-2">Pengaturan Akun</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Kelola identitas profil, perbarui kata sandi, dan pantau aktivitas sesi perangkat Anda.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 bg-emerald-50 dark:bg-emerald-950/20 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-900/50 rounded-xl text-sm font-semibold flex items-center gap-2 animate-slide-up shadow-sm">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-8">
            
            <div class="bg-white dark:bg-[#18181B] p-8 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm animate-slide-up" style="animation-delay: 0.15s;">
                <h2 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-6 flex items-center gap-2 border-b border-gray-50 dark:border-gray-800/50 pb-4">
                    <i class="fa-regular fa-id-card text-gray-400 dark:text-gray-500 text-base"></i> Informasi Profil
                </h2>

                <form action="{{ route('account.updateProfile') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 bg-gray-50 dark:bg-gray-800/30 p-5 rounded-xl border border-gray-100 dark:border-gray-800/50">
                        <div class="relative flex-shrink-0">
                            @if(auth()->user()->profile_photo && file_exists(public_path('uploads/profile/' . auth()->user()->profile_photo)))
                                <img id="avatar-preview" src="{{ asset('uploads/profile/' . auth()->user()->profile_photo) }}" alt="Foto Profil" class="w-24 h-24 rounded-full object-cover border-4 border-white dark:border-gray-700 shadow-sm">
                            @else
                                <div id="avatar-placeholder" class="w-24 h-24 rounded-full bg-blue-100 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 flex items-center justify-center font-extrabold text-3xl uppercase border-4 border-white dark:border-gray-700 shadow-sm">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                            @endif
                        </div>

                        <div class="flex-1 space-y-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">Foto Profil</label>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Mendukung format gambar JPEG, PNG, JPG dengan ukuran maksimal 2MB.</p>
                            <input type="file" name="profile_photo" id="profile_photo" accept="image/*" class="hidden" onchange="previewImage(this)">
                            <button type="button" onclick="document.getElementById('profile_photo').click()" class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 text-xs font-bold rounded-lg shadow-sm transition-all cursor-pointer">
                                <i class="fa-solid fa-cloud-arrow-up"></i> Pilih Foto Baru
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#18181B] focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all dark:text-white text-sm shadow-sm">
                            @error('name')
                                <p class="text-xs text-red-500 mt-1.5"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Alamat Email</label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#18181B] focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all dark:text-white text-sm shadow-sm">
                            @error('email')
                                <p class="text-xs text-red-500 mt-1.5"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t border-gray-50 dark:border-gray-800/50">
                        <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg text-sm shadow-md hover:shadow-lg transition-all cursor-pointer hover:-translate-y-0.5">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white dark:bg-[#18181B] p-8 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm animate-slide-up" style="animation-delay: 0.2s;">
                <h2 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-6 flex items-center gap-2 border-b border-gray-50 dark:border-gray-800/50 pb-4">
                    <i class="fa-solid fa-laptop-code text-gray-400 dark:text-gray-500 text-base"></i> Aktivitas Sesi Perangkat
                </h2>
                
                <div class="space-y-4">
                    @foreach($sessions as $session)
                        <div class="flex items-center justify-between p-4 border border-gray-100 dark:border-gray-800 rounded-xl bg-white dark:bg-[#18181B] shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex items-center gap-4 min-w-0">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl flex-shrink-0 {{ $session['is_current_device'] ? 'bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400' : 'bg-gray-50 dark:bg-gray-800 text-gray-500 dark:text-gray-400' }}">
                                    <i class="fa-solid {{ str_contains(strtolower($session['device_info']), 'android') || str_contains(strtolower($session['device_info']), 'ios') ? 'fa-mobile-screen-button' : 'fa-laptop' }}"></i>
                                </div>
                                <div class="truncate">
                                    <div class="flex items-center gap-2 mb-1">
                                        <h4 class="font-bold text-sm text-gray-900 dark:text-gray-100 truncate">
                                            {{ $session['device_info'] }}
                                        </h4>
                                        @if($session['is_current_device'])
                                            <span class="text-[9px] font-bold tracking-wider uppercase bg-emerald-100 text-emerald-700 dark:bg-emerald-900/50 dark:text-emerald-400 px-2 py-0.5 rounded-md border border-emerald-200 dark:border-emerald-800/30">
                                                Perangkat Ini
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 font-mono">
                                        IP: {{ $session['ip_address'] }} <span class="mx-1 text-gray-300 dark:text-gray-600">•</span> Aktif: {{ $session['last_active'] }}
                                    </p>
                                </div>
                            </div>

                            @if(!$session['is_current_device'])
                                <form action="{{ route('account.logoutSession', $session['id']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengeluarkan akun dari perangkat ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs font-bold text-red-600 hover:text-red-700 px-3 py-2 bg-red-50 hover:bg-red-100 dark:bg-red-900/20 dark:hover:bg-red-900/40 dark:text-red-400 rounded-lg cursor-pointer transition-colors border border-red-100 dark:border-red-900/30">
                                        Keluarkan
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

        <div class="space-y-8">
            <div class="bg-white dark:bg-[#18181B] p-8 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm animate-slide-up" style="animation-delay: 0.25s;">
                <h2 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-6 flex items-center gap-2 border-b border-gray-50 dark:border-gray-800/50 pb-4">
                    <i class="fa-solid fa-shield-halved text-gray-400 dark:text-gray-500 text-base"></i> Keamanan Akun
                </h2>

                <form action="{{ route('account.updatePassword') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <div>
                        <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Kata Sandi Lama</label>
                        <input type="password" name="old_password" placeholder="••••••••" required
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#18181B] focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all dark:text-white text-sm shadow-sm">
                        @error('old_password')
                            <p class="text-xs text-red-500 mt-1.5"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-2">
                        <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Kata Sandi Baru</label>
                        <input type="password" name="password" placeholder="Minimal 8 karakter" required
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#18181B] focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all dark:text-white text-sm shadow-sm">
                        @error('password')
                            <p class="text-xs text-red-500 mt-1.5"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Konfirmasi Sandi Baru</label>
                        <input type="password" name="password_confirmation" placeholder="••••••••" required
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#18181B] focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all dark:text-white text-sm shadow-sm">
                    </div>

                    <div class="pt-4 mt-2 border-t border-gray-50 dark:border-gray-800/50">
                        <button type="submit" class="w-full py-2.5 bg-gray-900 dark:bg-white text-white dark:text-gray-900 hover:bg-gray-800 dark:hover:bg-gray-100 font-bold rounded-lg text-sm shadow-md transition-all cursor-pointer">
                            Perbarui Kata Sandi
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                let preview = document.getElementById('avatar-preview');
                const placeholder = document.getElementById('avatar-placeholder');
                
                if (!preview) {
                    preview = document.createElement('img');
                    preview.id = 'avatar-preview';
                    preview.className = 'w-24 h-24 rounded-full object-cover border-4 border-white dark:border-gray-700 shadow-sm';
                    placeholder.parentNode.replaceChild(preview, placeholder);
                }
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection