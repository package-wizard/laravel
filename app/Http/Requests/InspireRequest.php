<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Data\InspireData;
use Spatie\LaravelData\Data;

/** @method InspireData dto() */
class InspireRequest extends Request
{
    protected Data|string $data = InspireData::class;

    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'string',
                'uuid',
            ],
        ];
    }
}
