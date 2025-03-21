<?php

use App\Http\Controllers\Web\IndexController;

app('router')
    ->name('index')
    ->get('/', IndexController::class);
