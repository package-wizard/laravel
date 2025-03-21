<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Data\QuoteData */
class InspireResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'quote'  => $this->quote,
            'author' => $this->author,
        ];
    }
}
