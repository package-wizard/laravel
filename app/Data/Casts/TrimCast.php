<?php

declare(strict_types=1);

namespace App\Data\Casts;

use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

use function trim;

class TrimCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): string
    {
        return trim($value);
    }
}
