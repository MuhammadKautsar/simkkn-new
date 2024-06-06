<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feature;
use App\Models\Level;
use App\Models\Setting;

class AdminController extends Controller
{
    public function index()
    {
        $nip = session()->get('nip');

        $roles = Level::with('features')->get();
        $features = Feature::all();
        return view('admin.settings', compact('roles', 'features', 'nip'));
    }

    public function update(Request $request)
    {
        $setting = Setting::find($request->id);
        $setting->update([
            'feature_id' => $request->feature_id,
            'level_id' => $request->level_id,
        ]);

        return redirect()->route('settings.index')->with('success', 'Akses fitur berhasil diubah');
    }

    public function destroy(Request $request)
    {
        $setting = Setting::where('level_id', $request->level_id)
                          ->where('feature_id', $request->feature_id)
                          ->first();
        if ($setting) {
            $setting->delete();
        }

        return redirect()->route('settings.index')->with('success', 'Akses fitur berhasil dihapus');
    }

    public function destroyAll(Request $request)
    {
        Setting::where('level_id', $request->level_id)->delete();

        return redirect()->route('settings.index')->with('success', 'Semua akses fitur berhasil dihapus');
    }

    public function store(Request $request)
    {
        $request->validate([
            'level_id' => 'required|exists:level,id',
            'feature_ids' => 'required|array',
            'feature_ids.*' => 'exists:features,id',
        ]);

        $role_id = $request->input('level_id');
        $feature_ids = $request->input('feature_ids');
        $errors = [];

        foreach ($feature_ids as $feature_id) {
            $existingSetting = Setting::where('level_id', $role_id)->where('feature_id', $feature_id)->first();

            if ($existingSetting) {
                $errors[] = 'Fitur tersebut sudah ada untuk role ini.';
            } else {
                Setting::create([
                    'level_id' => $role_id,
                    'feature_id' => $feature_id,
                ]);
            }
        }

        if (count($errors) > 0) {
            return redirect()->back()->withErrors($errors)->withInput();
        }

        return redirect()->route('settings.index')->with('success', 'Privilege fitur berhasil ditambahkan');
    }

    public function features(Request $request)
    {
        $nip = $request->session()->get('nip');
        $features = Feature::all();
        return view('admin.features', compact('features', 'nip'));
    }

    public function feature_store(Request $request)
    {
        $feature = new Feature();
        $feature->nama_fitur = $request->nama_fitur;
        $feature->save();

        // Redirect dengan pesan sukses
        return redirect()->route('features')->with('success', 'Fitur baru berhasil ditambahkan.');
    }

    public function feature_destroy($id)
    {
        $feature = Feature::find($id);

        if ($feature) {
            $feature->delete();
            return redirect()->route('features')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->route('features')->with('error', 'Data tidak ditemukan');
        }
    }

    public function feature_update(Request $request, $id)
    {
        $request->validate([
            'nama_fitur' => 'required|string|max:255',
        ]);

        $feature = Feature::find($id);
        if ($feature) {
            $feature->nama_fitur = $request->input('nama_fitur');
            $feature->save();

            return redirect()->route('features')->with('success', 'Data berhasil diupdate');
        } else {
            return redirect()->route('features')->with('error', 'Data tidak ditemukan');
        }
    }
}
