<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AccountController extends Controller
{
    // 1. Tampilkan Halaman Akun & Sesi Login Perangkat
    public function index(Request $request)
    {
        // Ambil data perangkat yang sedang login dari tabel sessions
        $sessions = DB::table('sessions')
            ->where('user_id', auth()->id())
            ->get()
            ->map(function ($session) use ($request) {
                return [
                    'id' => $session->id,
                    'ip_address' => $session->ip_address,
                    'is_current_device' => $session->id === $request->session()->getId(),
                    'device_info' => $this->parseUserAgent($session->user_agent),
                    'last_active' => date('d M Y, H:i', $session->last_activity)
                ];
            });

        return view('dashboard.account.index', compact('sessions'));
    }

    // 2. Ubah Nama, Email, & Upload Foto Profil
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:users,email,' . $user->id,
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // Logika upload foto langsung ke folder public/uploads/profile
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = 'profile_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            
            if (!file_exists(public_path('uploads/profile'))) {
                mkdir(public_path('uploads/profile'), 0755, true);
            }

            // Hapus foto profil yang lama jika ada
            if ($user->profile_photo && file_exists(public_path('uploads/profile/' . $user->profile_photo))) {
                @unlink(public_path('uploads/profile/' . $user->profile_photo));
            }

            $file->move(public_path('uploads/profile'), $filename);
            $user->profile_photo = $filename;
        }

        $user->save();

        return redirect()->route('account.index')->with('success', 'Profil berhasil diperbarui!');
    }

    // 3. Ubah Password (Wajib Masukkan Password Lama)
    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
            'password.min' => 'Kata sandi baru minimal 8 karakter.'
        ]);

        // Cek apakah password lama yang diinput cocok dengan di database
        if (!Hash::check($request->old_password, $user->password)) {
            throw ValidationException::withMessages([
                'old_password' => ['Kata sandi lama yang Anda masukkan salah.'],
            ]);
        }

        // Update password baru (otomatis di-hash berkat aturan cast di model User)
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('account.index')->with('success', 'Kata sandi berhasil diubah!');
    }

    // 4. Kick/Logout Perangkat Lain secara Remote
    public function logoutSession($id)
    {
        DB::table('sessions')
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->delete();

        return redirect()->route('account.index')->with('success', 'Perangkat berhasil dikeluarkan!');
    }

    // Fungsi pembantu untuk membaca spek perangkat (User Agent)
    private function parseUserAgent($userAgent)
    {
        $os = "Perangkat Tidak Dikenal";
        $browser = "Browser Tidak Dikenal";

        if (preg_match('/windows|win32/i', $userAgent)) { $os = 'Windows PC'; }
        elseif (preg_match('/macintosh|mac os x/i', $userAgent)) { $os = 'macOS'; }
        elseif (preg_match('/linux/i', $userAgent)) { $os = 'Linux'; }
        elseif (preg_match('/android/i', $userAgent)) { $os = 'Android'; }
        elseif (preg_match('/iphone|ipad/i', $userAgent)) { $os = 'iOS'; }

        if (preg_match('/opera|opr/i', $userAgent)) { $browser = 'Opera'; }
        elseif (preg_match('/edge/i', $userAgent)) { $browser = 'Edge'; }
        elseif (preg_match('/chrome/i', $userAgent)) { $browser = 'Chrome'; }
        elseif (preg_match('/safari/i', $userAgent)) { $browser = 'Safari'; }
        elseif (preg_match('/firefox/i', $userAgent)) { $browser = 'Firefox'; }

        return "$os • $browser";
    }
}