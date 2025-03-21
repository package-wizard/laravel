<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InspireResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'quote'  => $this->text,
            'author' => $this->author,
        ];
    }
}
