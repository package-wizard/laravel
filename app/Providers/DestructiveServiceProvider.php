<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class DestructiveServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->isProduction()
            ? $this->production()
            : $this->local();
    }

    protected function production(): void
    {
        DB::prohibitDestructiveCommands();
    }

    protected function local(): void
    {
        Model::preventLazyLoading();
    }
}
