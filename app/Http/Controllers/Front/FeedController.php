<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Response;

class FeedController extends Controller
{
    /** RSS 2.0 feed (son servisler). */
    public function index(): Response
    {
        $services = Service::where('is_published', true)->latest('published_at')->take(50)->get();
        $siteName = config('app.name', 'Denizli Teknik');
        $base = url('/');

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">' . "\n";
        $xml .= '  <channel>' . "\n";
        $xml .= '    <title>' . e($siteName) . '</title>' . "\n";
        $xml .= '    <link>' . e($base) . '</link>' . "\n";
        $xml .= '    <description>Denizli Teknik - Servis listesi</description>' . "\n";
        $xml .= '    <language>tr</language>' . "\n";
        $xml .= '    <lastBuildDate>' . ($services->first()?->updated_at?->toRssString() ?? now()->toRssString()) . '</lastBuildDate>' . "\n";
        $xml .= '    <atom:link href="' . e(route('feed')) . '" rel="self" type="application/rss+xml"/>' . "\n";

        foreach ($services as $service) {
            $link = route('servis.show', $service);
            $xml .= '    <item>' . "\n";
            $xml .= '      <title>' . e($service->title) . '</title>' . "\n";
            $xml .= '      <link>' . e($link) . '</link>' . "\n";
            $xml .= '      <guid isPermaLink="true">' . e($link) . '</guid>' . "\n";
            $xml .= '      <description><![CDATA[' . ($service->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($service->content), 300)) . ']]></description>' . "\n";
            $xml .= '      <pubDate>' . $service->published_at?->toRssString() . '</pubDate>' . "\n";
            $xml .= '    </item>' . "\n";
        }

        $xml .= '  </channel>' . "\n";
        $xml .= '</rss>';

        return response($xml, 200, [
            'Content-Type' => 'application/rss+xml; charset=UTF-8',
        ]);
    }
}
