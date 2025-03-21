<?php

namespace App\Data;

use App\Data\Casts\TrimCast;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class QuoteData extends Data
{
    #[MapInputName('text')]
    #[WithCast(TrimCast::class)]
    public string $quote;

    #[WithCast(TrimCast::class)]
    public string $author;
}
