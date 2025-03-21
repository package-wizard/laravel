<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\InspireResource;
use App\Services\InspireService;

readonly class InspireController
{
    public function __construct(
        protected InspireService $inspire
    ) {}

    public function __invoke()
    {
        return InspireResource::collection(
            $this->inspire->quotes()
        );
    }
}
