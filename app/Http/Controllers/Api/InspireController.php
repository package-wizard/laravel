<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\InspireRequest;
use App\Http\Resources\InspireResource;
use App\Services\InspireService;

readonly class InspireController
{
    public function __construct(
        protected InspireService $inspire
    ) {}

    public function __invoke(InspireRequest $request)
    {
        return InspireResource::collection(
            $this->inspire->quotes()
        )->additional([
            'data' => $request->dto(),
        ]);
    }
}
