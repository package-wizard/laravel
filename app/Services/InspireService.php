<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\QuoteData;
use DragonCode\Cache\Services\Cache;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Collection;

use function explode;

class InspireService
{
    /**
     * @return Collection<QuoteData>
     */
    public function quotes(): Collection
    {
        return Cache::make()
            ->ttl(10, false)
            ->key($this)
            ->remember(function () {
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
            });
    }

    public function quote(): string
    {
        return Inspiring::quote();
    }
}
