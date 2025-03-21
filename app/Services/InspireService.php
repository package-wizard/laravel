<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Collection;

use function explode;

class InspireService
{
    public function quotes(): Collection
    {
        return Inspiring::quotes()
            ->random()
            ->take(5)
            ->map(static function (string $quote) {
                [$text, $author] = explode('-', $quote);

                return [
                    'text'   => $text,
                    'author' => $author,
                ];
            });
    }

    public function quote(): string
    {
        return Inspiring::quote();
    }
}
