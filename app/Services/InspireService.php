<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\QuoteData;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Collection;

use function explode;

class InspireService
{
    /** @return Collection<QuoteData> */
    public function quotes(): Collection
    {
        return Inspiring::quotes()
            ->shuffle()
            ->take(5)
            ->map(static function (string $quote) {
                [$text, $author] = explode('-', $quote);

                return QuoteData::from([
                    'text'   => $text,
                    'author' => $author,
                ]);
            });
    }

    public function quote(): string
    {
        return Inspiring::quote();
    }
}
