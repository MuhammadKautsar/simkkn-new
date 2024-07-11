<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $nip = $request->session()->get('nip');
        $users = User::all();
        return view('admin.users-management', compact('users', 'nip'));
    }

    public function roles(Request $request)
    {
        $nip = $request->session()->get('nip');
        $roles = Level::all();
        return view('admin.roles', compact('roles', 'nip'));
    }

    public function store(Request $request)
    {
        // Validasi input
        // $request->validate([
        //     'nama' => 'required|string|max:255',
        // ]);

        $user = new User();
        // $user->nama = $request->nama;
        $user->nip = $request->nip;
        $user->level = $request->level;
        $user->keterangan = $request->keterangan;
        $user->save();

        // Redirect dengan pesan sukses
        return redirect()->route('users-management')->with('success', 'Panitia baru berhasil ditambahkan.');
    }

    public function destroy($nip)
    {
        $user = User::where('nip', $nip)->first();

        if ($user) {
            $user->delete();
            return redirect()->route('users-management')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->route('users-management')->with('error', 'Data tidak ditemukan');
        }
    }

    public function update(Request $request, $nip)
    {
        $request->validate([
            'nohp' => 'required|string|max:15',
            'level' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $user = User::where('nip', $nip)->first();
        if ($user) {
            $user->nohp = $request->input('nohp');
            $user->level = $request->input('level');
            $user->keterangan = $request->input('keterangan');
            $user->save();

            return redirect()->route('users-management')->with('success', 'Data berhasil diupdate');
        } else {
            return redirect()->route('users-management')->with('error', 'Data tidak ditemukan');
        }
    }

    // Metode untuk mengaktifkan pengguna
    public function activate($nip)
    {
        $user = User::where('nip', $nip)->first();
        if ($user) {
            $user->status = 1;
            $user->save();
            return redirect()->route('users-management')->with('success', 'Pengguna berhasil diaktifkan');
        }
        return redirect()->route('users-management')->with('error', 'Pengguna tidak ditemukan');
    }

    // Metode untuk menonaktifkan pengguna
    public function deactivate($nip)
    {
        $user = User::where('nip', $nip)->first();
        if ($user) {
            $user->status = 0;
            $user->save();
            return redirect()->route('users-management')->with('success', 'Pengguna berhasil dinonaktifkan');
        }
        return redirect()->route('users-management')->with('error', 'Pengguna tidak ditemukan');
    }

    public function role_store(Request $request)
    {
        $role = new Level();
        $role->nama_level = $request->nama_level;
        $role->save();

        // Redirect dengan pesan sukses
        return redirect()->route('roles')->with('success', 'Role baru berhasil ditambahkan.');
    }

    public function role_destroy($id)
    {
        $role = Level::find($id);

        if ($role) {
            $role->delete();
            return redirect()->route('roles')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->route('roles')->with('error', 'Data tidak ditemukan');
        }
    }

    public function role_update(Request $request, $id)
    {
        $request->validate([
            'nama_level' => 'required|string|max:255',
        ]);

        $role = Level::find($id);
        if ($role) {
            $role->nama_level = $request->input('nama_level');
            $role->save();

            return redirect()->route('roles')->with('success', 'Data berhasil diupdate');
        } else {
            return redirect()->route('roles')->with('error', 'Data tidak ditemukan');
        }
    }
}
