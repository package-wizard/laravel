<?php

use App\Console\Handler as ScheduleHandler;
use App\Exceptions\Handler as ExceptionsHandler;
use Illuminate\Foundation\Application;

return Application::configure(basePath: dirname(__DIR__))
    ->withExceptions(new ExceptionsHandler())
    ->withSchedule(new ScheduleHandler())
    ->withMiddleware()
    ->withRouting(
        web     : __DIR__ . '/../routes/web.php',
        api     : __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/playground.php',
    )
    ->create();
