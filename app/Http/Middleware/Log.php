<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Request as RequestModel;
class Log
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        RequestModel::create([
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'device' => isMobile(request()->userAgent()) ? 'mobile' : 'desktop',
            'url' => request()->url(),
            'date' => date('Y-m-d H:i:s'),
        ]);
        return $next($request);
    }
}
