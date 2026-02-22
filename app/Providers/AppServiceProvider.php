<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if ($assetUrl = config('app.asset_url')) {
            URL::forceRootUrl($assetUrl);
        }
        Paginator::useBootstrapFive();
        View::composer('front.layout', function ($view) {
            $view->with('categories', Category::where('is_active', true)->orderBy('order')->orderBy('name')->get())
                ->with('brands', Brand::where('is_active', true)->orderBy('order')->orderBy('name')->get());
        });
    }
}
