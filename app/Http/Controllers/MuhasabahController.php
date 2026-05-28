<?php

namespace App\Http\Controllers;

use App\Models\Muhasabah;
use Illuminate\Http\Request;

class MuhasabahController extends Controller
{
    // Tampilkan semua catatan milik user yang login
    public function index()
    {
        $muhasabahs = Muhasabah::where('user_id', auth()->id())
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        return view('muhasabah.index', compact('muhasabahs'));
    }

    // Tampilkan form buat catatan baru
    public function create()
    {
        return view('muhasabah.create');
    }

    // Simpan catatan baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'mood'    => 'nullable|string',
            'tanggal' => 'required|date',
        ]);

        Muhasabah::create([
            'user_id' => auth()->id(),
            'title'   => $request->title,
            'content' => $request->content,
            'mood'    => $request->mood,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('muhasabah.index')
            ->with('success', 'Catatan muhasabah berhasil disimpan! 🌙');
    }

    // Tampilkan detail satu catatan
    public function show(Muhasabah $muhasabah)
    {
        // Pastikan hanya pemilik yang bisa lihat
        abort_if($muhasabah->user_id !== auth()->id(), 403);

        return view('muhasabah.show', compact('muhasabah'));
    }

    // Tampilkan form edit catatan
    public function edit(Muhasabah $muhasabah)
    {
        abort_if($muhasabah->user_id !== auth()->id(), 403);

        return view('muhasabah.edit', compact('muhasabah'));
    }

    // Update catatan di database
    public function update(Request $request, Muhasabah $muhasabah)
    {
        abort_if($muhasabah->user_id !== auth()->id(), 403);

        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'mood'    => 'nullable|string',
            'tanggal' => 'required|date',
        ]);

        $muhasabah->update([
            'title'   => $request->title,
            'content' => $request->content,
            'mood'    => $request->mood,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('muhasabah.index')
            ->with('success', 'Catatan berhasil diperbarui! ✨');
    }

    // Hapus catatan
    public function destroy(Muhasabah $muhasabah)
    {
        abort_if($muhasabah->user_id !== auth()->id(), 403);

        $muhasabah->delete();

        return redirect()->route('muhasabah.index')
            ->with('success', 'Catatan berhasil dihapus.');
    }
}