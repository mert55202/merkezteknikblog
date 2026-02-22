<?php

namespace App\Http\Middleware;

use App\Models\SiteVisit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackSiteVisit
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($this->shouldTrack($request)) {
            SiteVisit::logVisit(
                $request->ip(),
                $request->userAgent(),
                $request->fullUrl()
            );
        }

        return $response;
    }

    private function shouldTrack(Request $request): bool
    {
        if ($request->is('admin*') || $request->is('_debugbar*') || $request->is('sanctum/*') || $request->is('track-search-click') || $request->is('track-service-click')) {
            return false;
        }

        if ($request->ajax() && ! $request->isMethod('GET')) {
            return false;
        }

        return true;
    }
}
