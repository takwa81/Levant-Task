<?php

use App\Http\Middleware\SetLocale;
use Dotenv\Exception\ValidationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'set.locale' => SetLocale::class,
            'auth.custom' => \App\Http\Middleware\AuthenticateMiddleware::class,
            'role.admin' => \App\Http\Middleware\CheckRoleAdmin::class,

        ]);

        $middleware->group('api', [
            'set.locale',
        ]);
    })->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => __('messages.errors.route_not_found'),
                'data' => [],
            ], 404);
        });

        $exceptions->render(function (MethodNotAllowedHttpException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => __('messages.errors.method_not_allowed'),
                'data' => [],
            ], 405);
        });

        $exceptions->render(function (ValidationException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => __('messages.errors.validation_failed'),
                'data' => $e->errors(),
            ], 422);
        });

        $exceptions->render(function (Throwable $e, $request) {
            return response()->json([
                'success' => false,
                'message' => __('messages.errors.unexpected_error'),
                'data' => [
                    'error' => $e->getMessage(),
                ],
            ], 500);
        });
    })->withProviders([
        App\Providers\RepositoryServiceProvider::class,
        App\Providers\EventServiceProvider::class,
    ])

    ->create();