<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('users-management', compact('users'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Simpan data KKN baru
        $user = new User();
        $user->nama = $request->nama;
        $user->nip = $request->nip;
        $user->level = $request->level;
        $user->password = $request->password;
        $user->save();

        // Redirect dengan pesan sukses
        return redirect()->route('users-management')->with('success', 'Panitia baru berhasil ditambahkan.');
    }
}
