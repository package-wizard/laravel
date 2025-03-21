<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Laravel\Telescope\Telescope;
use Laravel\Telescope\TelescopeServiceProvider as BaseTelescopeServiceProvider;

use function base_path;
use function realpath;

class TelescopeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->disabled()) {
            return;
        }

        $this->gate();
        $this->authorization();
        $this->bootMigrations();
    }

    protected function authorization(): void
    {
        Telescope::auth(fn () => $this->allow());
    }

    protected function gate(): void
    {
        Gate::define('viewTelescope', fn () => $this->allow());
    }

    protected function allow(): bool
    {
        return ! $this->app->isProduction();
    }

    protected function bootMigrations(): void
    {
        if ($path = realpath(base_path('vendor/laravel/telescope/database/migrations'))) {
            $this->loadMigrationsFrom($path);
        }
    }

    protected function disabled(): bool
    {
        return ! class_exists(BaseTelescopeServiceProvider::class) || ! config('telescope.enabled');
    }
}
