<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

class Kernel extends HttpKernel
{
  /**
   * The application's global HTTP middleware stack.
   *
   * @var array
   */
  protected $middleware = [
    // Other global middleware
  ];

  /**
   * The application's route middleware groups.
   *
   * @var array
   */
  protected $middlewareGroups = [
    'web' => [
      // \App\Http\Middleware\EncryptCookies::class,
      // \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
      // \Illuminate\Session\Middleware\StartSession::class,
      // Other web middleware
    ],

    'api' => [
      EnsureFrontendRequestsAreStateful::class,
      'throttle:api',
      \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],
  ];

  /**
   * The application's route middleware.
   *
   * @var array
   */
  protected $routeMiddleware = [
    // Define route middleware here
  ];
}
