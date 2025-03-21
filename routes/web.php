<?php

declare(strict_types=1);

use App\Http\Controllers\Web\IndexController;

app('router')
    ->name('index')
    ->get('/', IndexController::class);
