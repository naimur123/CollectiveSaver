<?php

use App\Http\Middleware\AuditTrailLog;
use App\Http\Middleware\CheckUserExist;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->alias(['valid_user' => CheckUserExist::class]);
        // $middleware->alias(['audit_trail' => AuditTrailLog::class]);
        $middleware->alias([
            'valid_user' => CheckUserExist::class,
            'audit_trail' => AuditTrailLog::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
