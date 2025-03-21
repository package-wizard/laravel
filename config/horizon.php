<?php

declare(strict_types=1);

use App\Enums\QueueEnum;
use App\Helpers\HorizonHelper;
use Illuminate\Support\Str;

return [
    'domain' => env('HORIZON_DOMAIN'),
    'path'   => env('HORIZON_PATH', 'horizon'),

    'use' => 'default',

    'prefix' => env(
        'HORIZON_PREFIX',
        Str::slug(env('APP_NAME', 'laravel'), '_') . '_horizon:'
    ),

    'middleware' => ['web'],

    'waits' => [
        'redis:default' => 60,
    ],

    'trim' => [
        'recent'        => 60,
        'pending'       => 60,
        'completed'     => 60,
        'recent_failed' => 10080,
        'failed'        => 10080,
        'monitored'     => 10080,
    ],

    'silenced' => [
        // App\Jobs\ExampleJob::class,
    ],

    'metrics' => [
        'trim_snapshots' => [
            'job'   => 24,
            'queue' => 24,
        ],
    ],

    'fast_termination' => false,

    'memory_limit' => 512,

    'defaults' => [
        QueueEnum::Deploy->value => HorizonHelper::make()
            ->queue(QueueEnum::Deploy)
            ->balance(false)
            ->timeout(0)
            ->toArray(),

        QueueEnum::Some->value => HorizonHelper::make()
            ->queue(QueueEnum::Some)
            ->timeout(0)
            ->toArray(),

        '*' => HorizonHelper::make()
            ->queue(QueueEnum::Default)
            ->toArray(),
    ],

    'environments' => [
        'production' => [
            QueueEnum::Deploy->value => HorizonHelper::optional()
                ->sleep(10)
                ->toArray(),

            QueueEnum::Some->value => HorizonHelper::optional()
                ->maxProcesses(2)
                ->toArray(),

            '*' => HorizonHelper::optional()
                ->maxProcesses(4)
                ->toArray(),
        ],

        '*' => [
            QueueEnum::Deploy->value => [],
            QueueEnum::Some->value   => [],

            '*' => [],
        ],
    ],
];
