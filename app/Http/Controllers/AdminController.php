<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Muhasabah;
use App\Models\Tracker;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUser     = User::where('role', 'user')->count();
        $totalCatatan  = Muhasabah::count();
        $totalTracker  = Tracker::count();
        $userTerbaru   = User::where('role', 'user')
                            ->orderBy('created_at', 'desc')
                            ->take(5)->get();
        $catatanHariIni = Muhasabah::whereDate('created_at', Carbon::today())->count();

        return view('admin.dashboard', compact(
            'totalUser', 'totalCatatan', 'totalTracker',
            'userTerbaru', 'catatanHariIni'
        ));
    }

    public function users()
    {
        $users = User::where('role', 'user')
                    ->withCount('muhasabahs')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return view('admin.users', compact('users'));
    }

    public function destroyUser(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.users')
                ->with('error', 'Tidak bisa menghapus akun admin!');
        }
        $user->delete();
        return redirect()->route('admin.users')
            ->with('success', 'Akun user berhasil dihapus.');
    }
}