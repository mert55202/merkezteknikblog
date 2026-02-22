<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SearchClick;
use App\Models\ServiceClick;
use App\Models\SiteVisit;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(): View
    {
        $days = 30;
        $visitorStats = $this->getDailyUniqueVisitorStats($days);
        $searchStats = $this->getDailyUniqueSearchClickStats($days);

        return view('admin.reports.index', [
            'visitorStats' => $visitorStats,
            'searchStats' => $searchStats,
        ]);
    }

    public function visitors(Request $request): JsonResponse
    {
        $query = SiteVisit::query()->select(['id', 'ip', 'user_agent', 'visited_at', 'url']);

        if ($request->filled('date_from')) {
            $query->whereDate('visited_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('visited_at', '<=', $request->date_to);
        }

        $total = $query->count();
        $perPage = (int) min(max((int) $request->get('length', 25), 10), 100);
        $start = (int) $request->get('start', 0);
        $page = $perPage > 0 ? floor($start / $perPage) + 1 : 1;
        $items = $query->orderByDesc('visited_at')->forPage($page, $perPage)->get();

        return response()->json([
            'draw' => (int) $request->get('draw', 1),
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $items->map(fn ($v) => [
                'id' => $v->id,
                'ip' => $v->ip,
                'user_agent' => $v->user_agent ?? '—',
                'visited_at' => $v->visited_at->format('d.m.Y H:i'),
                'url' => $v->url ? Str::limit($v->url, 60) : '—',
            ]),
        ]);
    }

    public function searchClicks(Request $request): JsonResponse
    {
        $query = SearchClick::query()->select(['id', 'ip', 'user_agent', 'clicked_at']);

        if ($request->filled('date_from')) {
            $query->whereDate('clicked_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('clicked_at', '<=', $request->date_to);
        }

        $total = $query->count();
        $perPage = (int) min(max((int) $request->get('length', 25), 10), 100);
        $start = (int) $request->get('start', 0);
        $page = $perPage > 0 ? floor($start / $perPage) + 1 : 1;
        $items = $query->orderByDesc('clicked_at')->forPage($page, $perPage)->get();

        return response()->json([
            'draw' => (int) $request->get('draw', 1),
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $items->map(fn ($c) => [
                'id' => $c->id,
                'ip' => $c->ip,
                'user_agent' => $c->user_agent ?? '—',
                'clicked_at' => $c->clicked_at->format('d.m.Y H:i'),
            ]),
        ]);
    }

    public function serviceClicks(Request $request): JsonResponse
    {
        $query = ServiceClick::query()
            ->with('service:id,title')
            ->select(['id', 'service_id', 'ip', 'user_agent', 'button_type', 'clicked_at'])
            ->orderByDesc('clicked_at');

        if ($request->filled('date_from')) {
            $query->whereDate('clicked_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('clicked_at', '<=', $request->date_to);
        }
        if ($request->filled('service_id')) {
            $query->where('service_id', $request->service_id);
        }

        $total = $query->count();
        $perPage = (int) min(max((int) $request->get('length', 25), 10), 100);
        $start = (int) $request->get('start', 0);
        $page = $perPage > 0 ? floor($start / $perPage) + 1 : 1;
        $items = $query->forPage($page, $perPage)->get();

        return response()->json([
            'draw' => (int) $request->get('draw', 1),
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $items->map(fn ($c) => [
                'id' => $c->id,
                'service_title' => $c->service?->title ?? '—',
                'button_type' => $c->button_type === 'ara' ? 'Ara' : 'Detay',
                'ip' => $c->ip,
                'user_agent' => $c->user_agent ?? '—',
                'clicked_at' => $c->clicked_at->format('d.m.Y H:i'),
            ]),
        ]);
    }

    private function getDailyUniqueVisitorStats(int $days): array
    {
        $from = Carbon::today()->subDays($days);
        $rows = SiteVisit::query()
            ->where('visited_at', '>=', $from)
            ->selectRaw('DATE(visited_at) as date, COUNT(DISTINCT ip) as unique_visitors')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('unique_visitors', 'date')
            ->toArray();

        $result = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $d = Carbon::today()->subDays($i)->format('Y-m-d');
            $result[] = [
                'date' => Carbon::parse($d)->format('d.m.Y'),
                'unique' => (int) ($rows[$d] ?? 0),
            ];
        }
        return $result;
    }

    private function getDailyUniqueSearchClickStats(int $days): array
    {
        $from = Carbon::today()->subDays($days);
        $rows = SearchClick::query()
            ->where('clicked_at', '>=', $from)
            ->selectRaw('DATE(clicked_at) as date, COUNT(DISTINCT ip) as unique_clicks')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('unique_clicks', 'date')
            ->toArray();

        $result = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $d = Carbon::today()->subDays($i)->format('Y-m-d');
            $result[] = [
                'date' => Carbon::parse($d)->format('d.m.Y'),
                'unique' => (int) ($rows[$d] ?? 0),
            ];
        }
        return $result;
    }
}
