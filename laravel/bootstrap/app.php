<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
  ->withRouting(
    web: __DIR__ . '/../routes/web.php',
    commands: __DIR__ . '/../routes/console.php',
    health: '/up',
  )
  ->withMiddleware(function (Middleware $middleware) {
    $middleware->statefulApi();
    // $middleware->group('api', [
    //   // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    //   // 'throttle:api',
    //   \Illuminate\Routing\Middleware\ThrottleRequests::class . ':api',
    //   \Illuminate\Routing\Middleware\SubstituteBindings::class,
    //   \App\Http\Middleware\EncryptCookies::class,
    //   \Illuminate\Session\Middleware\StartSession::class,
    // ]);
  })
  ->withExceptions(function (Exceptions $exceptions) {
    //
  })->create();
