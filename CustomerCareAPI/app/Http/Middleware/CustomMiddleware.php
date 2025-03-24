<?php
use App\Http\Middleware\CustomMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        apiPrefix: '/api',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Apply middleware to all routes
        $middleware->use([CustomMiddleware::class]);

        // Apply middleware only to web routes
        $middleware->web([CustomMiddleware::class]);

        // Apply middleware only to API routes
        $middleware->api([CustomMiddleware::class]);
    })
    ->create();
