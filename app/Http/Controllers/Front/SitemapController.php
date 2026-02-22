<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        $xml .= $this->url(route('home'), now()->format('Y-m-d'), 'weekly', '1.0');
        $xml .= $this->url(route('servis.index'), null, 'daily', '0.9');
        $xml .= $this->url(route('page.contact'), null, 'monthly', '0.7');

        foreach (Brand::where('is_active', true)->get() as $b) {
            $xml .= $this->url(route('servis.brand', $b), $b->updated_at->format('Y-m-d'), 'weekly', '0.8');
        }
        foreach (Category::where('is_active', true)->get() as $cat) {
            $xml .= $this->url(route('servis.category', $cat), $cat->updated_at->format('Y-m-d'), 'weekly', '0.8');
        }
        foreach (Service::where('is_published', true)->get() as $service) {
            $xml .= $this->url(route('servis.show', $service), $service->updated_at->format('Y-m-d'), 'monthly', '0.7');
        }

        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type' => 'application/xml',
            'Charset' => 'UTF-8',
        ]);
    }

    private function url(string $loc, ?string $lastmod, string $changefreq, string $priority): string
    {
        $loc = htmlspecialchars($loc, ENT_XML1, 'UTF-8');
        $line = "  <url><loc>{$loc}</loc>";
        if ($lastmod) {
            $line .= "<lastmod>{$lastmod}</lastmod>";
        }
        $line .= "<changefreq>{$changefreq}</changefreq><priority>{$priority}</priority></url>\n";
        return $line;
    }
}
