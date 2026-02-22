<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasAdminPermission
{
    /**
     * Handle an incoming request. Yetki yoksa 403 döner.
     *
     * @param  string  $permission  config('admin.roles.*.permissions') içindeki yetki adı (dashboard, categories, posts, site_contents, users)
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        if (! $request->user()?->hasPermission($permission)) {
            abort(403, 'Bu sayfaya erişim yetkiniz yok.');
        }

        return $next($request);
    }
}
