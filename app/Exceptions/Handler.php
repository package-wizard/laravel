<?php

declare(strict_types=1);

namespace App\Exceptions;

use Closure;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Http\Client\ConnectionException;
use Sentry\Laravel\Integration;
use Throwable;

class Handler
{
    protected array $dontReport = [
        ConnectionException::class,
    ];

    public function __invoke(Exceptions $exceptions): Exceptions
    {
        $exceptions->dontReport($this->dontReport);

        Integration::handles($exceptions);

        $exceptions->reportable($this->someReport());
        $exceptions->renderable($this->someRender());

        return $exceptions;
    }

    protected function someReport(): Closure
    {
        return function (Throwable $e) {
            // some report
        };
    }

    protected function someRender(): Closure
    {
        return function (Throwable $e) {
            // some render
        };
    }
}
