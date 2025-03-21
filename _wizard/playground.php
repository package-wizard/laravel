<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Artisan;

Artisan::command('foo', function () {
    dd(
        'Some action'
    );
});
