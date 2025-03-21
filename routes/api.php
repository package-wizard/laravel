<?php

declare(strict_types=1);

use App\Http\Controllers\Api\InspireController;

app('router')
    ->name('inspires')
    ->get('inspires', InspireController::class);
