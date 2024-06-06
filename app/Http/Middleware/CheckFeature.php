<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Setting;
use App\Models\User;

class CheckFeature
{
    public function handle($request, Closure $next, $feature)
    {
        // $user = Auth::user();
        $nip = session()->get('nip');

        $user = User::where('nip', $nip)->first();

        $level_id = $user->level;

        $setting = Setting::where('level_id', $level_id)
                          ->whereHas('feature', function ($query) use ($feature) {
                              $query->where('nama_fitur', $feature);
                          })
                          ->first();

        if (!$setting) {
            return redirect('/dashboard')->with('error', 'Fitur ini tidak tersedia untuk peran Anda.');
        }

        return $next($request);
    }
}
