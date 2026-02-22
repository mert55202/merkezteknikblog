<?php

namespace App\Http\Controllers;

use App\Models\ServiceClick;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TrackServiceClickController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $request->validate([
            'service_id' => 'required|integer|exists:services,id',
            'button_type' => 'nullable|string|in:ara,detay',
        ]);

        ServiceClick::logClick(
            (int) $request->service_id,
            $request->ip(),
            $request->userAgent(),
            $request->input('button_type', 'ara')
        );

        return response()->json(['ok' => true]);
    }
}
