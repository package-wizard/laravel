<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

use function config;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->setForceScheme();
    }

    protected function setForceScheme(): void
    {
        URL::forceScheme(
            Str::before(config('app.url'), ':')
        );
    }
}
