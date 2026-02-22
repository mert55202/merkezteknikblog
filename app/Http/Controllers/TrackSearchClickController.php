<?php

namespace App\Http\Controllers;

use App\Models\SearchClick;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackSearchClickController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $ip = $request->ip() ?? $request->server('REMOTE_ADDR') ?? '0.0.0.0';
        SearchClick::logClick($ip, $request->userAgent());

        if ($request->isMethod('get')) {
            $gif = base64_decode('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7');
            return response($gif, 200, [
                'Content-Type' => 'image/gif',
                'Cache-Control' => 'no-store, no-cache, must-revalidate',
            ]);
        }

        return response()->json(['ok' => true]);
    }
}
