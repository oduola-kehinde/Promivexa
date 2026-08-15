<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule; // ADD THIS LINE AT TOP

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
    web: __DIR__.'/../routes/web.php',
    api: __DIR__.'/../routes/api.php',  // ADD THIS LINE
    commands: __DIR__.'/../routes/console.php',
    health: '/up',
)
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withSchedule(function (Schedule $schedule) {  // ADD THIS WHOLE BLOCK
        $schedule->command('jap:send-tasks')->everyMinute();
    })
    ->create();