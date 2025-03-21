<?php

declare(strict_types=1);

use Illuminate\Concurrency\ConcurrencyServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\DestructiveServiceProvider::class,
    App\Providers\HorizonServiceProvider::class,
    App\Providers\TelescopeServiceProvider::class,
    App\Providers\TestServiceProvider::class,
    ConcurrencyServiceProvider::class,
];
