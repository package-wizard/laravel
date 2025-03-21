<?php

declare(strict_types=1);

return [
    'default' => env('QUEUE_CONNECTION', 'redis'),

    'default_ttl' => 300,

    'connections' => [
        'sync' => [
            'driver' => 'sync',
        ],

        'redis' => [
            'driver'       => 'redis',
            'connection'   => env('REDIS_QUEUE_CONNECTION', 'default'),
            'queue'        => env('REDIS_QUEUE', 'default'),
            'retry_after'  => (int) env('REDIS_QUEUE_RETRY_AFTER', 90),
            'block_for'    => null,
            'after_commit' => true,
        ],
    ],

    'batching' => [
        'database' => env('DB_CONNECTION', 'pgsql'),
        'table'    => 'job_batches',
    ],

    'failed' => [
        'driver'   => env('QUEUE_FAILED_DRIVER', 'database-uuids'),
        'database' => env('DB_CONNECTION', 'sqlite'),
        'table'    => 'failed_jobs',
    ],
];
