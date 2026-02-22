<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SiteContentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Front\ServiceController as FrontServiceController;
use App\Http\Controllers\Front\FeedController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\PageController;
use App\Http\Controllers\Front\SitemapController;
use App\Http\Controllers\TrackSearchClickController;
use App\Http\Controllers\TrackServiceClickController;
use Illuminate\Support\Facades\Route;

// Ön yüz (Porto)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/servisler', [FrontServiceController::class, 'index'])->name('servis.index');
Route::get('/servisler/marka/{brand:slug}', [FrontServiceController::class, 'brand'])->name('servis.brand');
Route::get('/servisler/kategori/{category:slug}', [FrontServiceController::class, 'category'])->name('servis.category');
Route::get('/servisler/{service:slug}', [FrontServiceController::class, 'show'])->name('servis.show');
Route::get('/iletisim', [PageController::class, 'contact'])->name('page.contact');
Route::match(['get', 'post'], '/track-search-click', TrackSearchClickController::class)->name('track.search.click');
Route::post('/track-service-click', TrackServiceClickController::class)->name('track.service.click');
Route::get('/feed.xml', [FeedController::class, 'index'])->name('feed');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', function () {
    $sitemap = route('sitemap');
    $feed = route('feed');
    return response("User-agent: *\nDisallow: /admin\n\nSitemap: {$sitemap}\n", 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
})->name('robots');

// Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('admin.permission:dashboard');
        Route::middleware('admin.permission:categories')->group(function () {
            Route::resource('categories', CategoryController::class)->except('show');
        });
        Route::middleware('admin.permission:brands')->group(function () {
            Route::resource('brands', BrandController::class)->except('show');
        });
        Route::middleware('admin.permission:services')->group(function () {
            Route::resource('services', ServiceController::class)->except('show');
        });
        Route::middleware('admin.permission:site_contents')->group(function () {
            Route::get('site-contents', [SiteContentController::class, 'index'])->name('site-contents.index');
            Route::put('site-contents', [SiteContentController::class, 'update'])->name('site-contents.update');
        });
        Route::middleware('admin.permission:users')->group(function () {
            Route::get('users', [UserController::class, 'index'])->name('users.index');
            Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
            Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
        });
        Route::middleware('admin.permission:reports')->group(function () {
            Route::get('raporlama', [ReportController::class, 'index'])->name('reports.index');
            Route::get('raporlama/visitors', [ReportController::class, 'visitors'])->name('reports.visitors');
            Route::get('raporlama/search-clicks', [ReportController::class, 'searchClicks'])->name('reports.search-clicks');
            Route::get('raporlama/service-clicks', [ReportController::class, 'serviceClicks'])->name('reports.service-clicks');
        });
    });
});
