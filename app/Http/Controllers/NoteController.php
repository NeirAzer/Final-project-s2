<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Folder;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $notes = auth()->user()->notes()
            ->with('folder')
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get();

        return view('dashboard.notes.index', compact('notes', 'search'));
    }

    public function create()
    {
        $folders = auth()->user()->folders ?? collect();

        return view('dashboard.notes.create', compact('folders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'folder_id' => 'nullable|exists:folders,id',
        ]);

        auth()->user()->notes()->create([
            'title' => $request->title,
            'content' => $request->content,
            'folder_id' => $request->folder_id,
        ]);

        return redirect()->route('notes.index')->with('success', 'Catatan berhasil dibuat!');
    }

    public function show(Note $note)
    {
        if ($note->user_id !== auth()->id()) {
            abort(403);
        }

        return view('dashboard.notes.show', compact('note'));
    }

    public function edit(Note $note)
    {
        if ($note->user_id !== auth()->id()) {
            abort(403);
        }

        $folders = auth()->user()->folders ?? collect();

        return view('dashboard.notes.edit', compact('note', 'folders'));
    }

    public function update(Request $request, Note $note)
    {
        if ($note->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'folder_id' => 'nullable|exists:folders,id',
        ]);

        $note->update([
            'title' => $request->title,
            'content' => $request->content,
            'folder_id' => $request->folder_id,
        ]);

        return redirect()->route('notes.index')->with('success', 'Catatan berhasil diperbarui!');
    }

    public function destroy(Note $note)
    {
        if ($note->user_id !== auth()->id()) {
            abort(403);
        }

        $note->delete();

        return redirect()->route('notes.index')->with('success', 'Catatan berhasil dihapus!');
    }
}