<?php
declare(strict_types=1);

namespace App\Providers;

use App\Http\Middleware\ForceJsonResponse;
use App\Support\ApiExceptionRenderer;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Throwable;

final class ByfallApiServiceProvider extends ServiceProvider
{
    public function boot(Router $router, ExceptionHandler $handler, ApiExceptionRenderer $renderer): void
    {
        $router->pushMiddlewareToGroup('api', ForceJsonResponse::class);
        $handler->shouldRenderJsonWhen(
            static fn (Request $request, Throwable $exception): bool =>
                $request->is('api/*') || $request->expectsJson(),
        );
        $handler->renderable(
            static fn (Throwable $exception, Request $request) =>
                $renderer->render($request, $exception, (bool) config('app.debug')),
        );
    }
}