<?php

use App\Http\Middleware\EnsureUserHasAdminPermission;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo('/admin/login');
        $middleware->alias([
            'admin.permission' => EnsureUserHasAdminPermission::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            'track-search-click',
            'track-service-click',
        ]);
        $middleware->web(append: [
            \App\Http\Middleware\TrackSiteVisit::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
