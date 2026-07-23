<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Muhasabah;
use Illuminate\Http\Request;

class MuhasabahController extends Controller
{
    public function index()
    {
        $muhasabahs = Muhasabah::where('user_id', auth()->id())
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        return response()->json($muhasabahs);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'mood'    => 'nullable|string',
            'tanggal' => 'required|date',
        ]);

        $muhasabah = Muhasabah::create([
            'user_id' => auth()->id(),
            'title'   => $request->title,
            'content' => $request->content,
            'mood'    => $request->mood,
            'tanggal' => $request->tanggal,
        ]);

        return response()->json([
            'message'    => 'Catatan berhasil disimpan!',
            'muhasabah'  => $muhasabah,
        ], 201);
    }

    public function show(Muhasabah $muhasabah)
    {
        abort_if($muhasabah->user_id !== auth()->id(), 403);

        return response()->json($muhasabah);
    }

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

        return response()->json([
            'message'   => 'Catatan berhasil diperbarui!',
            'muhasabah' => $muhasabah,
        ]);
    }

    public function destroy(Muhasabah $muhasabah)
    {
        abort_if($muhasabah->user_id !== auth()->id(), 403);

        $muhasabah->delete();

        return response()->json([
            'message' => 'Catatan berhasil dihapus.',
        ]);
    }

    public function byTanggal($tanggal)
    {
        $muhasabahs = Muhasabah::where('user_id', auth()->id())
            ->whereDate('tanggal', $tanggal)
            ->orderBy('tanggal', 'desc')
            ->get();

        return response()->json($muhasabahs);
    }
}