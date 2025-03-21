<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;

pest()
    ->uses(Tests\TestCase::class)
    ->in('Feature', 'Unit')
    ->beforeEach(function (): void {
        Http::preventStrayRequests();
    });
