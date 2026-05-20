<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $folders = auth()->user()->folders()
            ->withCount('notes')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get();

        return view('dashboard.folders.index', compact('folders', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        auth()->user()->folders()->create([
            'name' => $request->name,
        ]);

        return redirect()->route('folders.index')->with('success', 'Folder berhasil dibuat!');
    }

    public function update(Request $request, Folder $folder)
    {
        if ($folder->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $folder->update([
            'name' => $request->name,
        ]);

        return redirect()->route('folders.index')->with('success', 'Nama folder berhasil diperbarui!');
    }

    public function show(Request $request, Folder $folder)
    {
        if ($folder->user_id !== auth()->id()) {
            abort(403);
        }

        $search = $request->query('search');

        $notes = $folder->notes()
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get();

        return view('dashboard.folders.show', compact('folder', 'notes', 'search'));
    }

    public function destroy(Folder $folder)
    {
        if ($folder->user_id !== auth()->id()) {
            abort(403);
        }

        $folder->delete();

        return redirect()->route('folders.index')->with('success', 'Folder berhasil dihapus!');
    }
}