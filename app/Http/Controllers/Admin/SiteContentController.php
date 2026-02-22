<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ContentHelper;
use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use Illuminate\Http\Request;

class SiteContentController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->get('page', 'header');
        $contents = SiteContent::where('page', $page)->orderBy('order')->get();
        $pages = SiteContent::select('page')->distinct()->pluck('page');
        return view('admin.site-contents.index', compact('contents', 'page', 'pages'));
    }

    public function update(Request $request)
    {
        $keys = array_merge(array_keys($request->except('_token', '_method')), array_keys($request->allFiles()));
        $keys = array_filter($keys, fn ($k) => $k !== 'page'); // sayfa filtresi name'i gönderilmişse
        $contents = SiteContent::whereIn('key', $keys)->get();
        $updated = 0;
        foreach ($contents as $content) {
            $key = $content->key;
            if ($content->type === 'image') {
                if ($request->hasFile($key)) {
                    $path = ContentHelper::saveToPublicUploads($request->file($key));
                    $content->update(['value' => $path]);
                    SiteContent::forgetCache($key);
                    $updated++;
                }
            } else {
                $value = $request->input($key);
                $content->update(['value' => $value ?? '']);
                SiteContent::forgetCache($key);
                $updated++;
            }
        }
        return redirect()->route('admin.site-contents.index', ['page' => $request->get('page', 'header')])->with('success', $updated > 0 ? 'İçerikler güncellendi.' : 'Değişiklik yapılmadı.');
    }
}
