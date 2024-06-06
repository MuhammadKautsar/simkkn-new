<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Setting;

class CheckFeatureStatus
{
    public function handle(Request $request, Closure $next, $feature)
    {
        $setting = Setting::where('feature_name', $feature)->first();
        if (!$setting || !$setting->is_active) {
            return redirect()->route('dashboard')->with('error', 'Fitur tidak aktif');
        }

        return $next($request);
    }
}
